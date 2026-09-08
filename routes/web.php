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

    $activeRequest = EmergencyRequest::where(
        'customer_id',
        auth()->id()
    )
        ->whereNotIn('status', [
            'completed',
            'cancelled'
        ])
        ->latest()
        ->first();

    return view('customer.dashboard', [
        'serviceCategories' => $serviceCategories,
        'activeRequest' => $activeRequest,
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

Route::post(
    '/demo-logout',
    [CustomerAuthController::class, 'logout']
)->name('demo.logout');