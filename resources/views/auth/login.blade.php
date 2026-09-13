@extends('layouts.app')

@section('content')

<section class="login-section">

<div class="login-card">

<div class="section-label">
ACCOUNT ACCESS
</div>

<h1>
SIGN IN
</h1>

@if(session('success'))
    <div style="background: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; font-weight: 600;">
        ✓ {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background: #fee2e2; border: 1px solid #ef4444; color: #991b1b; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; font-weight: 600;">
        ⚠️ {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div style="background: #fee2e2; border: 1px solid #ef4444; color: #991b1b; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; font-weight: 600;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="demo-box">
<strong>SECURE ACCOUNT SIGN IN</strong>
<p>Sign in using your registered email, password, and account type.</p>

<div style="margin-top: 14px; padding-top: 10px; border-top: 1px dashed #cbd5e1; display: flex; gap: 8px; flex-wrap: wrap;">
    <span style="font-size: 12px; font-weight: 800; color: #64748b; width: 100%; margin-bottom: 4px;">⚡ QUICK DEMO LOGINS:</span>
    <button type="button" class="btn-demo-fill" onclick="fillDemo('customer@seh.com.bd', '12345678', 'customer')" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; padding: 5px 12px; border-radius: 6px; font-size: 11px; font-weight: 800; cursor: pointer;">
        👤 Customer
    </button>
    <button type="button" class="btn-demo-fill" onclick="fillDemo('rapidcare@seh.com.bd', '12345678', 'provider')" style="background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; padding: 5px 12px; border-radius: 6px; font-size: 11px; font-weight: 800; cursor: pointer;">
        🚑 Provider
    </button>
    <button type="button" class="btn-demo-fill" onclick="fillDemo('admin@seh.com.bd', '12345678', 'admin')" style="background: #fdf2f8; color: #be185d; border: 1px solid #fbcfe8; padding: 5px 12px; border-radius: 6px; font-size: 11px; font-weight: 800; cursor: pointer;">
        🛡️ Admin
    </button>
</div>
</div>

<form method="POST" action="{{ route('demo.login') }}" id="loginForm">
@csrf

<input type="hidden" name="intended" value="{{ request('intended') }}">

<label>EMAIL</label>
<input 
type="email" 
name="email"
id="emailInput"
value="{{ old('email') }}"
placeholder="you@example.com"
required
>

<label>PASSWORD</label>
<input 
type="password"
name="password"
id="passwordInput"
placeholder="••••••••"
required
>

<label>ROLE</label>

@php
    $selectedRole = old('role', 'customer');
@endphp

<div class="role-buttons">

<label class="role {{ $selectedRole === 'customer' ? 'active' : '' }}" id="roleLabelCustomer">
<input type="radio" name="role" value="customer" id="roleCustomer" {{ $selectedRole === 'customer' ? 'checked' : '' }}>
CUSTOMER
</label>

<label class="role {{ $selectedRole === 'provider' ? 'active' : '' }}" id="roleLabelProvider">
<input type="radio" name="role" value="provider" id="roleProvider" {{ $selectedRole === 'provider' ? 'checked' : '' }}>
PROVIDER
</label>

<label class="role {{ $selectedRole === 'admin' ? 'active' : '' }}" id="roleLabelAdmin">
<input type="radio" name="role" value="admin" id="roleAdmin" {{ $selectedRole === 'admin' ? 'checked' : '' }}>
ADMIN
</label>

</div>

<button class="login-btn" type="submit">
SIGN IN
</button>

<div class="register-links">
    <span>No account?</span>
    <a href="{{ route('customer.register') }}">
        <strong>REGISTER AS CUSTOMER</strong>
    </a>
    <span class="separator">·</span>
    <a href="{{ route('provider.register') }}">
        <strong>AS PROVIDER</strong>
    </a>
</div>

</form>

</div>

<script>
function selectRole(roleValue) {
    const roles = document.querySelectorAll(".role");
    roles.forEach(function(item){
        item.classList.remove("active");
    });

    const radio = document.querySelector(`input[name="role"][value="${roleValue}"]`);
    if (radio) {
        radio.checked = true;
        radio.closest('.role').classList.add('active');
    }
}

function fillDemo(email, password, role) {
    document.getElementById('emailInput').value = email;
    document.getElementById('passwordInput').value = password;
    selectRole(role);
}

document.addEventListener("DOMContentLoaded", function(){
    const roles = document.querySelectorAll(".role");
    roles.forEach(function(role){
        role.addEventListener("click", function(){
            roles.forEach(function(item){
                item.classList.remove("active");
            });
            this.classList.add("active");
            const radio = this.querySelector("input");
            if (radio) {
                radio.checked = true;
            }
        });
    });
});
</script>

</section>

@endsection