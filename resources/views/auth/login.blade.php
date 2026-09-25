@extends('layouts.app')

@section('title', 'Sign In — Smart Emergency Helper')

@section('content')

<style>
/* =========================================================
   LOGIN PAGE 
   ========================================================= */

.login-page-wrapper {
    background-color: #f8fafc;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px 16px;
}
.login-card-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 28px 24px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}
.login-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.login-card-box h1 {
    font-size: 20px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 16px;
}

.login-form-group {
    margin-bottom: 12px;
}
.login-form-group label {
    display: block;
    font-size: 9.5px;
    font-weight: 800;
    color: #475569;
    margin-bottom: 4px;
    letter-spacing: 0.3px;
    text-transform: uppercase;
}
.login-form-group input {
    width: 100%;
    padding: 8px 10px;
    font-size: 12px;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    background: #ffffff;
    color: #0f172a;
    box-sizing: border-box;
}
.login-form-group input:focus {
    outline: none;
    border-color: #dc2626;
}

.role-selector-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 6px;
    margin-top: 4px;
}
.role-choice-btn {
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    color: #475569;
    padding: 7px 4px;
    font-size: 10px;
    font-weight: 800;
    border-radius: 4px;
    text-align: center;
    cursor: pointer;
}
.role-choice-btn.active {
    background: #0f172a;
    color: #ffffff;
    border-color: #0f172a;
}

.btn-login-submit {
    width: 100%;
    background: #dc2626;
    color: #ffffff;
    border: none;
    padding: 9px 14px;
    font-size: 12px;
    font-weight: 800;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
    transition: background 0.15s;
}
.btn-login-submit:hover {
    background: #b91c1c;
}

.login-footer-links {
    margin-top: 16px;
    padding-top: 12px;
    border-top: 1px solid #f1f5f9;
    font-size: 11px;
    color: #64748b;
    text-align: center;
}
.login-footer-links a {
    color: #0f172a;
    font-weight: 700;
    text-decoration: none;
}
.login-footer-links a:hover {
    color: #dc2626;
    text-decoration: underline;
}
</style>

<div class="login-page-wrapper">
    <div class="login-card-box">
        <div class="login-eyebrow">ACCOUNT ACCESS · DHAKA DISPATCH</div>
        <h1>SIGN IN</h1>

        @if(session('login_error'))
            <div style="background:#fee2e2; border:1px solid #fca5a5; color:#991b1b; padding:8px 10px; border-radius:4px; margin-bottom:12px; font-size:11px;">
                 {{ session('login_error') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background:#fee2e2; border:1px solid #fca5a5; color:#991b1b; padding:8px 10px; border-radius:4px; margin-bottom:12px; font-size:11px;">
                <ul style="margin:0; padding-left:14px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('demo.login') }}">
            @csrf
            <input type="hidden" name="intended" value="{{ request('intended') }}">

            <div class="login-form-group">
                <label for="login_email">Email Address</label>
                <input type="email" name="email" id="login_email" value="{{ old('email') }}" placeholder="you@example.com" required>
            </div>

            <div class="login-form-group">
                <label for="login_password">Password</label>
                <input type="password" name="password" id="login_password" placeholder="••••••••" required>
            </div>

            <div class="login-form-group">
                <label>Select Role</label>
                @php $currentRole = old('role', request('role', 'customer')); @endphp
                <div class="role-selector-grid">
                    <label class="role-choice-btn {{ $currentRole === 'customer' ? 'active' : '' }}">
                        <input type="radio" name="role" value="customer" {{ $currentRole === 'customer' ? 'checked' : '' }} hidden>
                        CUSTOMER
                    </label>
                    <label class="role-choice-btn {{ $currentRole === 'provider' ? 'active' : '' }}">
                        <input type="radio" name="role" value="provider" {{ $currentRole === 'provider' ? 'checked' : '' }} hidden>
                        PROVIDER
                    </label>
                    <label class="role-choice-btn {{ $currentRole === 'admin' ? 'active' : '' }}">
                        <input type="radio" name="role" value="admin" {{ $currentRole === 'admin' ? 'checked' : '' }} hidden>
                        ADMIN
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-login-submit">
                SIGN IN 
            </button>

            <div class="login-footer-links">
                <span>No account?</span>
                <a href="{{ route('customer.register') }}">Customer Register</a>
                <span>·</span>
                <a href="{{ route('provider.register') }}">Provider Register</a>
                <div style="margin-top:8px;">
                    <a href="{{ route('home') }}" style="color:#64748b; font-size:10.5px;">Back to Homepage</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(){
    const roles = document.querySelectorAll(".role-choice-btn");
    roles.forEach(function(role){
        role.addEventListener("click", function(){
            roles.forEach(function(item){ item.classList.remove("active"); });
            this.classList.add("active");
            const radio = this.querySelector("input");
            if (radio) radio.checked = true;
        });
    });
});
</script>

@endsection