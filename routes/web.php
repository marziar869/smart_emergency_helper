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
use App\Http\Controllers\AdminController;





Route::middleware('auth')->group(function(){


Route::get(
'/provider/requests',
[ProviderRequestController::class,'index']
)
->name('provider.requests');



Route::post('/provider/request/accept/{id}',
[
    ProviderRequestController::class,'accept'
])
->name('provider.request.accept');


Route::post(
'/provider/request/{id}/reject',
[ProviderRequestController::class,'reject']
)
->name('provider.request.reject');



Route::post(
'/provider/request/{id}/status',
[ProviderRequestController::class,'updateStatus']
)
->name('provider.request.status');

Route::post(
'/provider/status',
[ProviderRequestController::class, 'updateAvailability']
)
->name('provider.status');

});

Route::get('/register/provider', [ProviderRegistrationController::class, 'create'])
    ->name('provider.register');

Route::post('/register/provider', [ProviderRegistrationController::class, 'store'])
    ->name('provider.register.submit');


/*
|--------------------------------------------------------------------------
| ADD THIS HERE
|--------------------------------------------------------------------------
*/

Route::get('/provider/verification', function () {
    if (!Auth::check() || Auth::user()->role !== 'provider') {
        return redirect()->route('login');
    }

    if (!session()->has('provider_reg_otp')) {
        session(['provider_reg_otp' => (string) random_int(100000, 999999)]);
    }
    $otp = session('provider_reg_otp');

    return view('provider.verification', compact('otp'));
})->name('provider.verification');

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

    $validOtp = session('provider_reg_otp');

    if (!$validOtp || trim($request->otp) !== (string) $validOtp) {
        return back()
            ->withErrors([
                'otp' => 'Invalid OTP code. Please enter the dynamic OTP code shown below.'
            ]);
    }

    $provider = auth()->user()->providerProfile;

    if ($provider) {
        $provider->update([
            'phone_verified' => true,
            'phone_verified_at' => now(),
        ]);
    }

    session()->forget('provider_reg_otp');

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


Route::get('/providers', function (Request $request) {
    $category = $request->query('category');
    $query = \App\Models\User::where('role', 'provider')
        ->with(['providerProfile.serviceCategory']);

    if ($category && strtolower($category) !== 'all') {
        $query->whereHas('providerProfile.serviceCategory', function($q) use ($category) {
            $catLower = strtolower($category);
            $q->whereRaw('LOWER(group_name) LIKE ?', ["%{$catLower}%"])
              ->orWhereRaw('LOWER(name) LIKE ?', ["%{$catLower}%"]);
        });
    }

    $providers = $query->latest()->get();
    $categories = \App\Models\ServiceCategory::all();

    return view('providers', compact('providers', 'categories', 'category'));
})->name('providers');


Route::get(
    '/providers/rapid-care-ambulance',
    fn() => view('provider-details')
)->name('providers.show');


Route::get('/about', fn() => view('about'))
    ->name('about');


Route::get('/contact', fn() => view('contact'))
    ->name('contact');



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

Route::post(
    '/logout',
    [CustomerAuthController::class, 'logout']
)->name('demo.logout');

Route::get(
    '/logout',
    [CustomerAuthController::class, 'logout']
)->name('logout');

/* =====================================================
   ADMIN ROUTES
===================================================== */
Route::get('/admin', [AdminController::class, 'dashboard'])
    ->name('admin');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

Route::get('/admin-panel', [AdminController::class, 'dashboard'])
    ->name('admin.panel');

Route::get('/admin/provider-verification-review/{providerId}', [AdminController::class, 'reviewProvider'])
    ->name('admin.provider.verification.review');

Route::post('/admin/provider/{id}/approve', [AdminController::class, 'approveProvider'])
    ->name('admin.provider.approve');

Route::post('/admin/provider/{id}/reject', [AdminController::class, 'rejectProvider'])
    ->name('admin.provider.reject');

Route::post('/admin/user/{id}/toggle-status', [AdminController::class, 'toggleUserStatus'])
    ->name('admin.user.toggle');

Route::post('/admin/category/{id}/toggle', [AdminController::class, 'toggleCategory'])
    ->name('admin.category.toggle');


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
   CUSTOMER DASHBOARD & LIFECYCLE ROUTES
===================================================== */

Route::get('/customer/dashboard', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role !== 'customer') {
        abort(403, 'Customer access only.');
    }

    $serviceCategories = ServiceCategory::where('is_active', true)
        ->orderBy('group_name')
        ->orderBy('name')
        ->get();

    // Active request is any un-cancelled request that is not yet rated/completed
    $activeRequest = EmergencyRequest::where('customer_id', auth()->id())
        ->whereNotIn('status', ['cancelled'])
        ->where(function($query) {
            $query->where('status', '!=', 'completed')
                  ->orWhere('is_rated', false);
        })
        ->latest()
        ->first();

    $current = $activeRequest ? $activeRequest->current_step : 0;

    $completedRequests = EmergencyRequest::where('customer_id', auth()->id())
        ->where('status', 'completed')
        ->where('is_rated', true)
        ->latest()
        ->get();

    return view('customer.dashboard', [
        'serviceCategories' => $serviceCategories,
        'activeRequest' => $activeRequest,
        'current' => $current,
        'completedRequests' => $completedRequests,
    ]);
})->name('customer.dashboard');

Route::get('/customer/profile', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role !== 'customer') {
        abort(403, 'Customer access only.');
    }

    return view('customer.profile');
})->name('customer.profile');

Route::post(
    '/customer/emergency-request',
    [EmergencyRequestController::class, 'store']
)->name('customer.emergency.store');

Route::post(
    '/customer/request/{id}/advance',
    [EmergencyRequestController::class, 'advance']
)->name('customer.request.advance');

Route::post(
    '/customer/request/{id}/reset',
    [EmergencyRequestController::class, 'reset']
)->name('customer.request.reset');

Route::post(
    '/customer/request/{id}/verify-pin',
    [EmergencyRequestController::class, 'verifyPin']
)->name('customer.request.verify_pin');

Route::post(
    '/customer/request/{id}/upload-photo',
    [EmergencyRequestController::class, 'uploadPhoto']
)->name('customer.request.upload_photo');

Route::post(
    '/customer/request/{id}/rate',
    [EmergencyRequestController::class, 'rate']
)->name('customer.request.rate');

/* =====================================================
   PROVIDER DASHBOARD
===================================================== */

Route::get('/provider/dashboard', function () {
    if (!Auth::check() || Auth::user()->role !== 'provider') {
        return redirect()->route('login');
    }

    // Pending requests available to accept
    $requests = EmergencyRequest::where('status', 'pending')
        ->whereNull('assigned_provider_id')
        ->latest()
        ->get();

    // Active accepted job
    $activeJob = EmergencyRequest::where('assigned_provider_id', auth()->id())
        ->whereNotIn('status', ['cancelled'])
        ->where(function($query) {
            $query->where('status', '!=', 'completed')
                  ->orWhere('is_rated', false);
        })
        ->latest()
        ->first();

    $current = $activeJob ? $activeJob->current_step : 0;

    $completedJobs = EmergencyRequest::where('assigned_provider_id', auth()->id())
        ->where('status', 'completed')
        ->latest()
        ->get();

    return view('provider.dashboard', compact('requests', 'activeJob', 'current', 'completedJobs'));
})->name('provider.dashboard');

Route::post(
    '/provider/request/{id}/advance',
    [ProviderRequestController::class, 'advance']
)->name('provider.request.advance');

Route::post(
    '/provider/request/{id}/verify-pin',
    [EmergencyRequestController::class, 'verifyPin']
)->name('provider.request.verify_pin');
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
   EMERGENCY FORM
===================================================== */

Route::get('/emergency-form', function () {

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

Route::post(
    '/demo-logout',
    [CustomerAuthController::class, 'logout']
)->name('demo.logout');