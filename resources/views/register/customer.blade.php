@extends('layouts.app')

@section('title', 'Customer Registration — Smart Emergency Helper')

@section('content')

<style>
/* =========================================================
   CUSTOMER REGISTRATION STYLES (EMBEDDED IN BLADE)
   ========================================================= */

.scr-customer-register {
    background-color: #f8fafc;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px 16px;
}
.scr-register-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 24px;
    width: 100%;
    max-width: 520px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}
.scr-register-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.scr-register-title {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 4px;
}
.scr-register-description {
    font-size: 11.5px;
    color: #64748b;
    margin-bottom: 14px;
}

.scr-account-types {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    margin-bottom: 14px;
}
.scr-account-type {
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
.scr-account-type-active {
    background: #0f172a;
    color: #ffffff;
    border-color: #0f172a;
}

.scr-register-form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.scr-field {
    display: flex;
    flex-direction: column;
}
.scr-field-full {
    grid-column: 1 / -1;
}
.scr-field label {
    font-size: 9.5px;
    font-weight: 800;
    color: #475569;
    margin-bottom: 4px;
    text-transform: uppercase;
}
.scr-field input,
.scr-field select {
    width: 100%;
    padding: 7px 10px;
    font-size: 12px;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    background: #ffffff;
    color: #0f172a;
    box-sizing: border-box;
}
.scr-field input:focus,
.scr-field select:focus {
    outline: none;
    border-color: #dc2626;
}

.scr-create-account-btn {
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
.scr-create-account-btn:hover {
    background: #b91c1c;
}

.scr-register-login {
    margin-top: 14px;
    padding-top: 10px;
    border-top: 1px solid #f1f5f9;
    font-size: 11px;
    color: #64748b;
    text-align: center;
}
.scr-register-login a {
    color: #0f172a;
    font-weight: 700;
    text-decoration: none;
}
.scr-register-login a:hover {
    color: #dc2626;
    text-decoration: underline;
}

@media (max-width: 540px) {
    .scr-register-form {
        grid-template-columns: 1fr;
    }
}
</style>

<section class="scr-customer-register">
    <div class="scr-register-card">
        <div class="scr-register-eyebrow">CLIENT REGISTRATION · DHAKA</div>
        <h1 class="scr-register-title">CREATE A CUSTOMER ACCOUNT</h1>
        <p class="scr-register-description">
            Register once, then submit emergency requests with instant priority dispatch.
        </p>

        @if ($errors->any())
            <div style="background:#fee2e2; border:1px solid #fca5a5; padding:10px 12px; margin-bottom:12px; border-radius:4px; color:#991b1b; font-size:11px;">
                <strong>Registration failed:</strong>
                <ul style="margin:6px 0 0 16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="scr-account-types">
            <a href="{{ route('customer.register') }}" class="scr-account-type scr-account-type-active">
                CUSTOMER
            </a>
            <a href="{{ route('provider.register') }}" class="scr-account-type">
                SERVICE PROVIDER
            </a>
        </div>

        <form class="scr-register-form" method="POST" action="{{ route('customer.register.submit') }}">
            @csrf

            <div class="scr-field">
                <label for="full_name">Full Name</label>
                <input id="full_name" name="full_name" type="text" placeholder="e.g. Md. Arif Hossain" required>
            </div>

            <div class="scr-field">
                <label for="phone">Phone Number</label>
                <input id="phone" name="phone" type="text" placeholder="+880 17XX-XXXXXX" required>
            </div>

            <div class="scr-field scr-field-full">
                <label for="email">Email Address</label>
                <input id="email" name="email" type="email" placeholder="you@example.com" required>
            </div>

            <div class="scr-field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="••••••••" required>
            </div>

            <div class="scr-field">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="••••••••" required>
            </div>

            <div class="scr-field">
                <label for="area">Dhaka Area</label>
                <select id="area" name="area" required>
                    <option value="Dhanmondi">Dhanmondi</option>
                    <option value="Gulshan">Gulshan</option>
                    <option value="Banani">Banani</option>
                    <option value="Uttara">Uttara</option>
                    <option value="Mirpur">Mirpur</option>
                    <option value="Mohammadpur">Mohammadpur</option>
                </select>
            </div>

            <div class="scr-field">
                <label for="address">Detailed Address</label>
                <input id="address" name="address" type="text" placeholder="e.g. Road 8A, House 42" required>
            </div>

            <button type="submit" class="scr-create-account-btn">
                CREATE CUSTOMER ACCOUNT →
            </button>
        </form>

        <p class="scr-register-login">
            <span>Already registered?</span>
            <a href="{{ route('login') }}">SIGN IN</a>
            <span style="margin: 0 4px;">·</span>
            <a href="{{ route('home') }}" style="color:#64748b;">Home</a>
        </p>
    </div>
</section>

@endsection