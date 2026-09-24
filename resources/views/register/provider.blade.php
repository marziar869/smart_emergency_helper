@extends('layouts.app')

@section('title', 'Provider Registration — Smart Emergency Helper')

@section('content')

<style>
/* =========================================================
   PROVIDER REGISTRATION STYLES (EMBEDDED IN BLADE)
   ========================================================= */

.spr-page {
    background-color: #f8fafc;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px 16px;
}
.spr-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 24px;
    width: 100%;
    max-width: 540px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}
.spr-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.spr-title {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 4px;
}
.spr-description {
    font-size: 11.5px;
    color: #64748b;
    margin-bottom: 14px;
}

.spr-account-switch {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    margin-bottom: 14px;
}
.spr-switch-btn {
    text-align: center;
    padding: 7px 4px;
    font-size: 11px;
    font-weight: 800;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    text-decoration: none;
    color: #475569;
    background: #f8fafc;
}
.spr-switch-btn.active {
    background: #0f172a;
    color: #ffffff;
    border-color: #0f172a;
}

.spr-progress {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 4px;
    margin-bottom: 14px;
}
.spr-progress-item {
    background: #f1f5f9;
    padding: 4px;
    font-size: 9px;
    font-weight: 800;
    color: #64748b;
    border-radius: 3px;
    text-align: center;
}
.spr-progress-item.active {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fca5a5;
}

.spr-form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.spr-field {
    display: flex;
    flex-direction: column;
}
.spr-full {
    grid-column: 1 / -1;
}
.spr-field label {
    font-size: 9.5px;
    font-weight: 800;
    color: #475569;
    margin-bottom: 4px;
    text-transform: uppercase;
}
.spr-field input,
.spr-field select {
    width: 100%;
    padding: 7px 10px;
    font-size: 12px;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    background: #ffffff;
    color: #0f172a;
    box-sizing: border-box;
}
.spr-field input:focus,
.spr-field select:focus {
    outline: none;
    border-color: #dc2626;
}

.spr-submit {
    grid-column: 1 / -1;
    background: #dc2626;
    color: #ffffff;
    border: none;
    padding: 10px 14px;
    font-size: 12px;
    font-weight: 800;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 6px;
    transition: background 0.15s;
}
.spr-submit:hover {
    background: #b91c1c;
}

.spr-login {
    margin-top: 14px;
    padding-top: 10px;
    border-top: 1px solid #f1f5f9;
    font-size: 11px;
    color: #64748b;
    text-align: center;
}
.spr-login a {
    color: #0f172a;
    font-weight: 700;
    text-decoration: none;
}
.spr-login a:hover {
    color: #dc2626;
    text-decoration: underline;
}

@media (max-width: 540px) {
    .spr-form {
        grid-template-columns: 1fr;
    }
}
</style>

<section class="spr-page">
    <div class="spr-card">
        <div class="spr-eyebrow">PROVIDER REGISTRATION · DHAKA</div>
        <h1 class="spr-title">APPLY AS A SERVICE PROVIDER</h1>
        <p class="spr-description">
            Submit your details. Verify phone by OTP, then administrator reviews your credentials.
        </p>

        <div class="spr-account-switch">
            <a href="{{ route('customer.register') }}" class="spr-switch-btn">
                CUSTOMER
            </a>
            <a href="{{ route('provider.register') }}" class="spr-switch-btn active">
                SERVICE PROVIDER
            </a>
        </div>

        <div class="spr-progress">
            <div class="spr-progress-item active">01 ACCOUNT</div>
            <div class="spr-progress-item">02 PHONE OTP</div>
            <div class="spr-progress-item">03 REVIEW</div>
            <div class="spr-progress-item">04 VERIFIED</div>
        </div>

        @if ($errors->any())
            <div style="background:#fee2e2; border:1px solid #fca5a5; padding:10px 12px; margin-bottom:12px; border-radius:4px; color:#991b1b; font-size:11px;">
                @foreach ($errors->all() as $error)
                    <p style="margin:2px 0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form class="spr-form" method="POST" action="{{ route('provider.register.submit') }}">
            @csrf

            <div class="spr-field">
                <label for="name">Provider Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="e.g. Rapid Care Ambulance" required>
            </div>

            <div class="spr-field">
                <label for="phone">Phone Number</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone') }}" placeholder="+880 17XX-XXXXXX" required>
            </div>

            <div class="spr-field spr-full">
                <label for="email">Email Address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="you@example.com" required>
            </div>

            <div class="spr-field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="••••••••" required>
            </div>

            <div class="spr-field">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="••••••••" required>
            </div>

            <div class="spr-field">
                <label for="area">Primary Service Area</label>
                <select id="area" name="area" required>
                    <option value="Dhanmondi" @selected(old('area') === 'Dhanmondi')>Dhanmondi</option>
                    <option value="Gulshan" @selected(old('area') === 'Gulshan')>Gulshan</option>
                    <option value="Banani" @selected(old('area') === 'Banani')>Banani</option>
                    <option value="Uttara" @selected(old('area') === 'Uttara')>Uttara</option>
                    <option value="Mirpur" @selected(old('area') === 'Mirpur')>Mirpur</option>
                    <option value="Mohammadpur" @selected(old('area') === 'Mohammadpur')>Mohammadpur</option>
                </select>
            </div>

            <div class="spr-field">
                <label for="category">Service Category</label>
                <select id="category" name="category" required>
                    <option value="Ambulance" @selected(old('category') === 'Ambulance')>Ambulance</option>
                    <option value="Blood Donor" @selected(old('category') === 'Blood Donor')>Blood Donor</option>
                    <option value="Home Nurse" @selected(old('category') === 'Home Nurse')>Home Nurse</option>
                    <option value="Electrician" @selected(old('category') === 'Electrician')>Electrician</option>
                    <option value="Plumber" @selected(old('category') === 'Plumber')>Plumber</option>
                    <option value="AC Technician" @selected(old('category') === 'AC Technician')>AC Technician</option>
                    <option value="Cleaner" @selected(old('category') === 'Cleaner')>Cleaner</option>
                    <option value="Carpenter" @selected(old('category') === 'Carpenter')>Carpenter</option>
                </select>
            </div>

            <div class="spr-field">
                <label for="experience">Years of Experience</label>
                <input id="experience" name="experience" type="number" min="0" value="{{ old('experience', 5) }}" required>
            </div>

            <div class="spr-field">
                <label for="address">Base Address</label>
                <input id="address" name="address" type="text" value="{{ old('address') }}" placeholder="e.g. House 14, Road 8" required>
            </div>

            <button type="submit" class="spr-submit">
                SUBMIT PROVIDER APPLICATION →
            </button>
        </form>

        <p class="spr-login">
            <span>Already registered?</span>
            <a href="{{ route('login') }}">SIGN IN</a>
            <span style="margin:0 4px;">·</span>
            <a href="{{ route('home') }}" style="color:#64748b;">Home</a>
        </p>
    </div>
</section>

@endsection