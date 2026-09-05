@extends('layouts.app')

@section('content')

<div class="provider-verification-page">

<div class="provider-verification-container">


<!-- HEADER -->

<div class="verification-header">

<p class="section-label">
PROVIDER ONBOARDING
</p>


<h1>
PROVIDER VERIFICATION
</h1>


<p>
Provider accounts activate only after phone ownership verification (OTP) and administrator approval.
</p>

</div>





<!-- STEPS -->

<div class="verification-steps">


<div class="verification-step active">

<small>01</small>

<strong>
ACCOUNT CREATED
</strong>

</div>



<div class="verification-step current">

<small>02</small>

<strong>
PHONE OTP
</strong>

</div>



<div class="verification-step">

<small>03</small>

<strong>
ADMIN REVIEW
</strong>

</div>



<div class="verification-step">

<small>04</small>

<strong>
VERIFIED
</strong>

</div>


</div>



@if(session('otp_error'))

    <div class="spr-error-box">
        {{ session('otp_error') }}
    </div>

@endif


@if(session('otp_success'))

    <div class="spr-success-box">
        {{ session('otp_success') }}
    </div>

@endif

<!-- OTP CARD -->

<div class="verification-card">


<div class="step-label">
STEP 02
</div>



<h2>
VERIFY YOUR PHONE
</h2>



<p class="phone-number">
+880 17•••••21
</p>
<form
    id="otpForm"
    method="POST"
    action="{{ route('provider.verification.submit') }}"
>
    @csrf

    <input
        type="hidden"
        name="otp"
        id="otpValue"
    >




<!-- OTP INPUT -->

<div class="otp-boxes">

    <input type="text" maxlength="1" class="otp-input">

    <input type="text" maxlength="1" class="otp-input">

    <input type="text" maxlength="1" class="otp-input">

    <input type="text" maxlength="1" class="otp-input">

    <input type="text" maxlength="1" class="otp-input">

    <input type="text" maxlength="1" class="otp-input">

</div>






<!-- TIMER -->

<div class="otp-header">

<span class="expire">

CODE EXPIRES IN <span id="timer">01:37</span>

</span>

</div>



<!-- EXPIRED MESSAGE -->

<div id="otpExpired" class="otp-expired">

Expired OTP — request a new code

</div>






<!-- BUTTONS -->

<div class="verification-buttons">


<button
    type="submit"
    id="verifyOtpBtn"
    class="verify-btn"
>
    VERIFY OTP
</button>
</form>


<button id="resendOtpBtn" class="resend-btn">

RESEND CODE

</button>


</div>







<!-- DEMO -->

<div class="demo-code">

<h3>Demo code for this frontend preview: 482931</h3>

</div>



</div>








<!-- BUSINESS RULE -->

<div class="verification-card business-rule">


<p class="step-label">

BUSINESS RULE

</p>



<h4>

A PROVIDER CANNOT RECEIVE REQUESTS UNTIL: PHONE OWNERSHIP VERIFIED (OTP) + ADMIN APPROVED.

</h4>


</div>





</div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const otpInputs =
        document.querySelectorAll('.otp-input');

    const otpValue =
        document.getElementById('otpValue');

    const otpForm =
        document.getElementById('otpForm');


    otpInputs.forEach(function (input, index) {

        input.addEventListener('input', function () {

            this.value =
                this.value.replace(/\D/g, '');

            if (
                this.value &&
                index < otpInputs.length - 1
            ) {
                otpInputs[index + 1].focus();
            }

        });


        input.addEventListener('keydown', function (event) {

            if (
                event.key === 'Backspace' &&
                !this.value &&
                index > 0
            ) {
                otpInputs[index - 1].focus();
            }

        });

    });


    otpForm.addEventListener('submit', function (event) {

        let otp = '';

        otpInputs.forEach(function (input) {
            otp += input.value;
        });

        if (otp.length !== 6) {

            event.preventDefault();

            alert('Please enter the complete 6-digit OTP.');

            return;
        }

        otpValue.value = otp;

    });

});
</script>

@endsection