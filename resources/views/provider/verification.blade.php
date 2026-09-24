@extends('layouts.app')

@section('title', 'Provider OTP Verification — Smart Emergency Helper')

@section('content')

<style>
/* =========================================================
   PROVIDER OTP VERIFICATION STYLES (EMBEDDED IN BLADE)
   ========================================================= */

.provider-verification-page {
    background-color: #f8fafc;
    min-height: 100vh;
    padding: 24px 0 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.provider-verification-container {
    max-width: 500px;
    width: 100%;
    margin: 0 auto;
    padding: 0 16px;
}

.verification-header {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px;
    margin-bottom: 12px;
    text-align: center;
}
.section-label {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.verification-header h1 {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 4px;
}

.verification-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 24px;
    text-align: center;
}
.phone-number {
    font-size: 13px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 14px;
}
.otp-boxes {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin: 16px 0;
}
.otp-input {
    width: 44px;
    height: 48px;
    font-size: 20px;
    font-weight: 800;
    text-align: center;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    background: #f8fafc;
    color: #0f172a;
}
.otp-input:focus {
    outline: none;
    border-color: #dc2626;
    background: #ffffff;
}

.verify-btn {
    width: 100%;
    background: #dc2626;
    color: #ffffff;
    border: none;
    padding: 10px 14px;
    font-size: 12px;
    font-weight: 800;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
}
.verify-btn:hover { background: #b91c1c; }

.demo-code {
    background: #fef3c7;
    border: 1px solid #fde68a;
    color: #92400e;
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 11.5px;
    font-weight: 700;
    margin-top: 14px;
}
</style>

<div class="provider-verification-page">
    <div class="provider-verification-container">

        <div class="verification-header">
            <p class="section-label">PROVIDER ONBOARDING · STEP 2</p>
            <h1>PHONE OTP VERIFICATION</h1>
            <p style="font-size:11.5px; color:#64748b; margin:0;">Confirm phone ownership to qualify for admin review.</p>
        </div>

        @if($errors->any())
            <div style="background:#fee2e2; border:1px solid #fca5a5; color:#991b1b; padding:8px 12px; border-radius:4px; font-size:11px; margin-bottom:12px;">
                @foreach ($errors->all() as $error)
                    <p style="margin:0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="verification-card">
            <p class="phone-number">One-time PIN sent to your phone ({{ auth()->user()->phone ?? 'Registered number' }})</p>

            <form id="otpForm" method="POST" action="{{ route('provider.verification.submit') }}">
                @csrf
                <input type="hidden" name="otp" id="otpValue">

                <div class="otp-boxes">
                    <input type="text" maxlength="1" class="otp-input" autofocus>
                    <input type="text" maxlength="1" class="otp-input">
                    <input type="text" maxlength="1" class="otp-input">
                    <input type="text" maxlength="1" class="otp-input">
                    <input type="text" maxlength="1" class="otp-input">
                    <input type="text" maxlength="1" class="otp-input">
                </div>

                <button type="submit" class="verify-btn">
                    VERIFY PHONE OTP →
                </button>
            </form>

            <div class="demo-code">
                Your Person Verification OTP: <strong>{{ $otp ?? session('provider_reg_otp', '482931') }}</strong>
            </div>

            <div style="margin-top:14px;">
                <a href="{{ route('home') }}" style="color:#64748b; font-size:11px; text-decoration:none;">← Return to Home</a>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const otpInputs = document.querySelectorAll('.otp-input');
    const otpValue = document.getElementById('otpValue');
    const otpForm = document.getElementById('otpForm');

    otpInputs.forEach(function (input, index) {
        input.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');
            if (this.value && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', function (event) {
            if (event.key === 'Backspace' && !this.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });
    });

    otpForm.addEventListener('submit', function (event) {
        let otp = '';
        otpInputs.forEach(function (input) { otp += input.value; });
        if (otp.length !== 6) {
            event.preventDefault();
            alert('Please enter your 6-digit verification OTP.');
            return;
        }
        otpValue.value = otp;
    });
});
</script>

@endsection