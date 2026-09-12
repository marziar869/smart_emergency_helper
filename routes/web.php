<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\EmergencyRequestController;
use App\Models\ServiceCategory;
use App\Models\EmergencyRequest;
use App\Http\Controllers\ProviderRegistrationController;
use App\Http\Controllers\ProviderRequestController;
use App\Http\Controllers\CustomerRequestController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\CustomerRequestStatusController;
use App\Http\Controllers\EmergencyStatusController;



Route::middleware('auth')->group(function(){


Route::get(
'/provider/requests',
[ProviderRequestController::class,'index']
)
->name('provider.requests');

Route::post('/provider/request/{id}/accept',
[
    ProviderRequestController::class,'accept'
])
->name('provider.request.accept');


Route::post(
'/provider/request/{id}/reject',
[ProviderRequestController::class,'reject']
)
->name('provider.request.reject');

Route::get(
    '/customer/request/{id}',
    [CustomerRequestController::class,'show']
)->name('customer.request.show');


Route::post(
'/provider/request/{id}/status',
[ProviderRequestController::class,'updateStatus']
)
->name('provider.request.status');


});

Route::get('/register/provider', [ProviderRegistrationController::class, 'create'])
    ->name('provider.register');

Route::post('/register/provider', [ProviderRegistrationController::class, 'store'])
    ->name('provider.register.submit');


/* =====================================================
   PROVIDER OTP VERIFICATION SUBMIT
===================================================== */

Route::post('/provider/verification', function (Request $request) {


    if (!auth()->check() || auth()->user()->role !== 'provider') {

        return redirect()->route('login');

    }


    $request->validate([

        'otp' => [
            'required',
            'digits:6'
        ]

    ]);



    // Demo OTP

    if ($request->otp != '482931') {


        return back()
            ->withErrors([
                'otp' => 'Invalid OTP code.'
            ]);

    }



    $provider = auth()->user()->providerProfile;



    if ($provider) {


        $provider->update([

            'phone_verified' => true,

            'phone_verified_at' => now(),

        ]);


    }



    return redirect()

        ->route('provider.dashboard')

        ->with(
            'success',
            'Phone verified successfully. Waiting for admin approval.'
        );


})->name('provider.verification.submit');

/* =====================================================
   PUBLIC PAGES
===================================================== */

Route::get('/', fn() => view('home'))
    ->name('home');


Route::get('/services', fn() => view('services'))
    ->name('services');


Route::get('/providers', fn() => view('providers'))
    ->name('providers');


Route::get(
    '/providers/rapid-care-ambulance',
    fn() => view('provider-details')
)->name('providers.show');


Route::get('/about', fn() => view('about'))
    ->name('about');


Route::get('/contact', fn() => view('contact'))
    ->name('contact');

    Route::get('/request-emergency', function () {

    if(!auth()->check()){
        return redirect()->route('login');
    }

    if(auth()->user()->role !== 'customer'){
        abort(403,'Customer access only.');
    }

    $serviceCategories = ServiceCategory::where('is_active', true)
        ->orderBy('group_name')
        ->orderBy('name')
        ->get();

    return view('customer.emergency-form', [
        'serviceCategories'=>$serviceCategories
    ]);

})->name('request.emergency');


/* =====================================================
   LOGIN
===================================================== */

Route::get('/login', function (Request $request) {

    return view('auth.login', [
        'intended' => $request->query('intended'),
    ]);

})->name('login');


Route::post(
    '/demo-login',
    [CustomerAuthController::class, 'login']
)->name('demo.login');


/* =====================================================
   CUSTOMER REGISTRATION
===================================================== */

Route::get(
    '/register/customer',
    fn() => view('register.customer')
)->name('customer.register');
Route::post(
    '/register/customer',
    [CustomerAuthController::class, 'register']
)->name('customer.register.submit');



/* =====================================================
   PROVIDER REGISTRATION
===================================================== */

Route::get('/register/provider', [
    ProviderRegistrationController::class,
    'create'
])->name('provider.register');



Route::post('/register/provider',
    [ProviderRegistrationController::class,'store']
)->name('provider.register.submit');


/* =====================================================
   CUSTOMER DASHBOARD
===================================================== */

Route::get('/customer/dashboard',
[
    CustomerDashboardController::class,'index'
])
->name('customer.dashboard');

Route::post(
'/customer/request/{id}/advance',
[CustomerDashboardController::class,'advance']
)
->name('customer.request.advance');

Route::post(
'/customer/request/{id}/reset',
[CustomerDashboardController::class,'reset']
)
->name('customer.request.reset');


Route::post(
    '/customer/emergency-request',
    [EmergencyRequestController::class,'store']
)->name('customer.emergency.store');

Route::get('/customer/profile', function () {

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role !== 'customer') {
        abort(403, 'Customer access only.');
    }

    return view('customer.profile');

})->name('customer.profile');

/* =====================================================
   PROVIDER DASHBOARD
===================================================== */

Route::get('/provider/dashboard', function () {


    if (!Auth::check() || Auth::user()->role !== 'provider') {

        return redirect()->route('login');

    }



    // Pending requests
    $requests = EmergencyRequest::where('status','pending')
        ->whereNull('assigned_provider_id')
        ->get();


    // Accepted active job
    $activeJob = EmergencyRequest::where(
        'assigned_provider_id',
        auth()->id()
    )
    ->where(
        'status',
        'accepted'
    )
    ->first();



    return view(
        'provider.dashboard',
        compact(
            'requests',
            'activeJob'
        )
    );


})->name('provider.dashboard');
/* =====================================================
   PROVIDER PROFILE
===================================================== */

Route::get('/provider/profile', function () {


    if (!Auth::check() || Auth::user()->role !== 'provider') {

        return redirect()->route('login');

    }


    return view('provider.profile');


})->name('provider.profile');



/* =====================================================
   PROVIDER OTP VERIFICATION
===================================================== */

Route::get('/provider/verification', function () {


    if (!Auth::check() || Auth::user()->role !== 'provider') {

        return redirect()->route('login');

    }


    return view('provider.verification');


})->name('provider.verification');


/* =====================================================
   ADMIN DASHBOARD
===================================================== */

Route::get('/admin/dashboard', function () {

    if (
        !session('demo_logged_in') ||
        session('demo_role') !== 'admin'
    ) {

        return redirect()->route('login');

    }


    /*
     * Newly registered provider applications
     */

    $providerApplications =
        session(
            'provider_applications',
            []
        );


    return view(
        'admin.dashboard',
        [

            'providerApplications' =>
                $providerApplications,

        ]
    );

})->name('admin.dashboard');



/* =====================================================
   ADMIN PROVIDER VERIFICATION REVIEW
===================================================== */

Route::get(
    '/admin/provider-verification/{provider}',
    function ($provider) {

        if (
            !session('demo_logged_in') ||
            session('demo_role') !== 'admin'
        ) {

            return redirect()
                ->route('login');

        }


        /*
         * Demo Provider Applications
         */

        $demoProviders = [

            'PRV-1052' => [

                'id' =>
                    'PRV-1052',

                'name' =>
                    'Nurse Farzana Akter',

                'category' =>
                    'Home Nurse',

                'phone' =>
                    '+880 1712-345678',

                'email' =>
                    'farzana.akter@seh.com.bd',

                'experience' =>
                    '6 Years',

                'area' =>
                    'Dhanmondi',

                'address' =>
                    'Dhanmondi, Dhaka',

                'created' =>
                    '12 Aug 2026',

                'submitted' =>
                    'Today · 10:42 AM',

                'phone_verified' =>
                    true,

                'status' =>
                    'PENDING ADMIN REVIEW',

            ],


            'PRV-1053' => [

                'id' =>
                    'PRV-1053',

                'name' =>
                    'VoltFix Electricals',

                'category' =>
                    'Electrician',

                'phone' =>
                    '+880 1812-456789',

                'email' =>
                    'voltfix@seh.com.bd',

                'experience' =>
                    '9 Years',

                'area' =>
                    'Mirpur',

                'address' =>
                    'Mirpur, Dhaka',

                'created' =>
                    '13 Aug 2026',

                'submitted' =>
                    'Today · 11:15 AM',

                'phone_verified' =>
                    true,

                'status' =>
                    'PENDING ADMIN REVIEW',

            ],


            'PRV-1054' => [

                'id' =>
                    'PRV-1054',

                'name' =>
                    'Dhaka Emergency Ambulance',

                'category' =>
                    'Ambulance',

                'phone' =>
                    '+880 1912-567890',

                'email' =>
                    'dhaka.ambulance@seh.com.bd',

                'experience' =>
                    '8 Years',

                'area' =>
                    'Uttara',

                'address' =>
                    'Uttara, Dhaka',

                'created' =>
                    '14 Aug 2026',

                'submitted' =>
                    'Today · 11:48 AM',

                'phone_verified' =>
                    true,

                'status' =>
                    'PENDING ADMIN REVIEW',

            ],

        ];


        /*
         * Registered applications
         */

        $registeredApplications =
            session(
                'provider_applications',
                []
            );


        /*
         * Merge Demo + Registered
         */

        $allProviders =
            array_merge(
                $demoProviders,
                $registeredApplications
            );


        /*
         * Invalid Provider ID → 404
         */

        abort_unless(
            isset($allProviders[$provider]),
            404
        );


        return view(
            'admin.provider-verification-review',
            [

                'providerId' =>
                    $provider,

                'provider' =>
                    $allProviders[$provider],

            ]
        );

    }
)->name(
    'admin.provider.verification.review'
);



/* =====================================================
   EMERGENCY FORM
===================================================== */

/*Route::get('/emergency-form', function () {

    return view('customer.emergency-form');

})->name('emergency.form');


Route::post('/emergency-form', function (Request $request) {

    $data = $request->validate([

        'service_group' => [
            'required',
            'in:Emergency,Technical,Home',
        ],

        'service_type' => [
            'required',
            'string',
        ],

        'priority' => [
            'required',
            'in:Critical,High,Medium,Normal',
        ],

        'area' => [
            'required',
            'string',
        ],

        'address' => [
            'required',
            'string',
            'max:255',
        ],

        'description' => [
            'required',
            'string',
            'max:1000',
        ],

    ]);


    $providerPools = [

        'Ambulance' => [
            'Rapid Care Ambulance',
            'Dhaka Emergency Ambulance',
            'City Rescue Ambulance',
        ],

        'Blood Donor' => [
            'LifeLine Blood Network',
            'Dhaka Blood Support',
            'Red Drop Donor Service',
        ],

        'Home Nurse' => [
            'CarePlus Home Nursing',
            'MediHome Nurse Service',
            'SafeCare Nursing',
        ],

        'Electrician' => [
            'VoltFix Electricals',
            'PowerCare Electric',
            'SparkPro Electrical Service',
        ],

        'Plumber' => [
            'Dhaka Plumbing Care',
            'PipeFix Services',
            'AquaWorks Plumbing',
        ],

        'AC Technician' => [
            'CoolCare AC Service',
            'FrostFix Solutions',
            'AirPro Technical',
        ],

        'Locksmith' => [
            'QuickLock Dhaka',
            'SecureKey Service',
            'LockCare 24/7',
        ],

        'Cleaner' => [
            'CleanNest Services',
            'Dhaka Home Clean',
            'SparkleCare Cleaning',
        ],

        'Carpenter' => [
            'WoodCraft Home Service',
            'Dhaka Carpenter Hub',
            'FixWood Services',
        ],

    ];


    $providers =
        $providerPools[$data['service_type']]
        ?? [
            'Verified Provider One',
            'Verified Provider Two',
            'Verified Provider Three',
        ];


    $reference =
        'REQ-' . random_int(100000, 999999);


    $attempts = [

        [
            'provider' => $providers[0],
            'status' => 'DECLINED',
        ],

        [
            'provider' => $providers[1],
            'status' => 'EXPIRED',
        ],

        [
            'provider' => $providers[2],
            'status' => 'ACCEPTED',
        ],

    ];


    $emergency = [

        'reference' =>
            $reference,

        'group' =>
            $data['service_group'],

        'service' =>
            $data['service_type'],

        'priority' =>
            $data['priority'],

        'area' =>
            $data['area'],

        'address' =>
            $data['address'],

        'description' =>
            $data['description'],

        'assigned_provider' =>
            $providers[2],

        'attempts' =>
            $attempts,

    ];


    session([
        'demo_emergency_request' =>
            $emergency,
    ]);


    return redirect()->route(
        'emergency.result'
    );

})->name('emergency.form.submit');
*/

/* =====================================================
   EMERGENCY RESULT
===================================================== */

Route::get('/emergency-result', function () {

    $emergency =
        session('demo_emergency_request');


    if (!$emergency) {

        return redirect()->route(
            'emergency.form'
        );

    }


    return view(
        'customer.emergency-result',
        [
            'emergency' =>
                $emergency,
        ]
    );

})->name('emergency.result');

/* =====================================================
   LOGOUT
===================================================== */


Route::post('/logout', [CustomerAuthController::class, 'logout']
)->name('demo.logout');