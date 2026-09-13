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

Route::post(
'/provider/availability',
[ProviderRequestController::class, 'updateAvailability']
)
->name('provider.availability.update');

Route::post(
'/provider/request/{id}/upload-photo',
[ProviderRequestController::class, 'uploadPhoto']
)
->name('provider.request.upload_photo');

Route::get(
'/provider/api/pending-alerts',
[ProviderRequestController::class, 'pendingAlertsApi']
)
->name('provider.api.pending_alerts');

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

use App\Http\Controllers\PublicPageController;

/* =====================================================
   PUBLIC PAGES
===================================================== */

Route::get('/', [PublicPageController::class, 'home'])
    ->name('home');

Route::get('/services', [PublicPageController::class, 'services'])
    ->name('services');

Route::get('/providers', [PublicPageController::class, 'providers'])
    ->name('providers');

Route::get('/providers/{id}', [PublicPageController::class, 'providerDetails'])
    ->name('providers.show');

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

    $providerProfile = Auth::user()->providerProfile;

    // Pending requests
    $requests = EmergencyRequest::where('status', 'pending')
        ->where(function($query) use ($providerProfile) {
            $query->whereNull('assigned_provider_id');
            if ($providerProfile && $providerProfile->service_category_id) {
                $query->orWhere('service_category_id', $providerProfile->service_category_id);
            }
        })
        ->latest()
        ->get();

    // Accepted / Active job across all active phases
    $activeJob = EmergencyRequest::where('assigned_provider_id', Auth::id())
        ->whereIn('status', [
            'accepted',
            'provider_assigned',
            'provider_on_way',
            'arrival_pending',
            'arrived',
            'working',
            'completion_pending'
        ])
        ->latest()
        ->first();

    // Provider performance stats
    $stats = [
        'completed_today' => EmergencyRequest::where('assigned_provider_id', Auth::id())
            ->where('status', 'completed')
            ->whereDate('updated_at', now()->today())
            ->count(),
        'total_completed' => EmergencyRequest::where('assigned_provider_id', Auth::id())
            ->where('status', 'completed')
            ->count(),
        'rating' => $providerProfile->rating ?? 4.9,
        'pending_count' => $requests->count(),
    ];

    return view('provider.dashboard', compact('requests', 'activeJob', 'providerProfile', 'stats'));

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


use App\Http\Controllers\AdminDashboardController;

/* =====================================================
   ADMIN DASHBOARD & PROVIDER VERIFICATION
===================================================== */

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::get('/admin/provider-verification/{provider}', [AdminDashboardController::class, 'reviewVerification'])
    ->name('admin.provider.verification.review');

Route::post('/admin/provider-verification/{provider}/approve', [AdminDashboardController::class, 'approveVerification'])
    ->name('admin.provider.approve');

Route::post('/admin/provider-verification/{provider}/reject', [AdminDashboardController::class, 'rejectVerification'])
    ->name('admin.provider.reject');



/* =====================================================
   EMERGENCY FORM & RESULT
===================================================== */

Route::get('/emergency-form', [EmergencyRequestController::class, 'create'])
    ->name('emergency.form');

Route::post('/emergency-form', [EmergencyRequestController::class, 'store'])
    ->name('emergency.form.submit');

Route::get('/emergency-result', [EmergencyRequestController::class, 'showResult'])
    ->name('emergency.result');

/* =====================================================
   LOGOUT
===================================================== */


Route::post('/logout', [CustomerAuthController::class, 'logout']
)->name('demo.logout');