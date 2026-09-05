@extends('layouts.app')

@section('content')

<section class="spr-page">

    <div class="spr-card">


        <!-- =========================================
             TOP LABEL
        ========================================== -->

        <div class="spr-eyebrow">
            PROVIDER REGISTRATION
        </div>


        <!-- =========================================
             TITLE
        ========================================== -->

        <h1 class="spr-title">
            APPLY AS A SERVICE PROVIDER
        </h1>


        <!-- =========================================
             DESCRIPTION
        ========================================== -->

        <p class="spr-description">
            Submit your details. Verify phone ownership by OTP,
            then an administrator reviews your application before approval.
        </p>



        <!-- =========================================
             CUSTOMER / PROVIDER SWITCH
        ========================================== -->

        <div class="spr-account-switch">

            <a
                href="{{ route('customer.register') }}"
                class="spr-switch-btn spr-customer-btn"
            >
                CUSTOMER
            </a>

            <a
                href="{{ route('provider.register') }}"
                class="spr-switch-btn spr-provider-btn active"
            >
                SERVICE PROVIDER
            </a>

        </div>



        <!-- =========================================
             REGISTRATION PROGRESS
        ========================================== -->

        <div class="spr-progress">

            <div class="spr-progress-item active">
                01 ACCOUNT
            </div>

            <div class="spr-progress-item">
                02 PHONE OTP
            </div>

            <div class="spr-progress-item">
                03 ADMIN REVIEW
            </div>

            <div class="spr-progress-item">
                04 VERIFIED
            </div>

        </div>



        <!-- =========================================
             VALIDATION ERRORS
        ========================================== -->

        @if ($errors->any())

            <div class="spr-error-box">

                @foreach ($errors->all() as $error)

                    <p>
                        {{ $error }}
                    </p>

                @endforeach

            </div>

        @endif



        <!-- ======================================
             FORM
        ========================================== -->

        <form
            class="spr-form"
            method="POST"
            action="{{ route('provider.register.submit') }}"
        >

            @csrf



            <!-- FULL NAME -->

            <div class="spr-field">

                <label for="name">
                    FULL NAME
                </label>

                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    placeholder="e.g. Md. Arif Hossain"
                    required
                >

            </div>



            <!-- PHONE -->

            <div class="spr-field">

                <label for="phone">
                    PHONE NUMBER
                </label>

                <input
                    id="phone"
                    name="phone"
                    type="text"
                    value="{{ old('phone') }}"
                    placeholder="+880 17XX-XXXXXX"
                    required
                >

            </div>



            <!-- EMAIL -->

            <div class="spr-field spr-full">

                <label for="email">
                    EMAIL
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    placeholder="you@example.com"
                    required
                >

            </div>



            <!-- PASSWORD -->

            <div class="spr-field">

                <label for="password">
                    PASSWORD
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="••••••••"
                    required
                >

            </div>



            <!-- CONFIRM PASSWORD -->

            <div class="spr-field">

                <label for="password_confirmation">
                    CONFIRM PASSWORD
                </label>

                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    placeholder="••••••••"
                    required
                >

            </div>



            <!-- AREA -->

            <div class="spr-field">

                <label for="area">
                    PRIMARY SERVICE AREA
                </label>

                <select
                    id="area"
                    name="area"
                    required
                >

                    <option value="">
                        Select service area
                    </option>

                    <option
                        value="Dhanmondi"
                        {{ old('area') === 'Dhanmondi' ? 'selected' : '' }}
                    >
                        Dhanmondi
                    </option>

                    <option
                        value="Gulshan"
                        {{ old('area') === 'Gulshan' ? 'selected' : '' }}
                    >
                        Gulshan
                    </option>

                    <option
                        value="Banani"
                        {{ old('area') === 'Banani' ? 'selected' : '' }}
                    >
                        Banani
                    </option>

                    <option
                        value="Uttara"
                        {{ old('area') === 'Uttara' ? 'selected' : '' }}
                    >
                        Uttara
                    </option>

                    <option
                        value="Mirpur"
                        {{ old('area') === 'Mirpur' ? 'selected' : '' }}
                    >
                        Mirpur
                    </option>

                    <option
                        value="Mohakhali"
                        {{ old('area') === 'Mohakhali' ? 'selected' : '' }}
                    >
                        Mohakhali
                    </option>

                    <option
                        value="Bashundhara"
                        {{ old('area') === 'Bashundhara' ? 'selected' : '' }}
                    >
                        Bashundhara
                    </option>

                    <option
                        value="Badda"
                        {{ old('area') === 'Badda' ? 'selected' : '' }}
                    >
                        Badda
                    </option>

                </select>

            </div>



            <!-- BASE ADDRESS -->

            <div class="spr-field">

                <label for="address">
                    DETAILED SERVICE ADDRESS / BASE LOCATION
                </label>

                <input
                    id="address"
                    name="address"
                    type="text"
                    value="{{ old('address') }}"
                    placeholder="e.g. Road 8A, House 42"
                    required
                >

            </div>



            <!-- SERVICE CATEGORY -->

            <div class="spr-field">

                <label for="category">
                    SERVICE CATEGORY
                </label>

                <select
                    id="category"
                    name="category"
                    required
                >

                    <option value="">
                        Select service category
                    </option>

                    <option
                        value="Ambulance"
                        {{ old('category') === 'Ambulance' ? 'selected' : '' }}
                    >
                        Ambulance
                    </option>

                    <option
                        value="Blood Donor"
                        {{ old('category') === 'Blood Donor' ? 'selected' : '' }}
                    >
                        Blood Donor
                    </option>

                    <option
                        value="Home Nurse"
                        {{ old('category') === 'Home Nurse' ? 'selected' : '' }}
                    >
                        Home Nurse
                    </option>

                    <option
                        value="Electrician"
                        {{ old('category') === 'Electrician' ? 'selected' : '' }}
                    >
                        Electrician
                    </option>

                    <option
                        value="Plumber"
                        {{ old('category') === 'Plumber' ? 'selected' : '' }}
                    >
                        Plumber
                    </option>

                    <option
                        value="AC Technician"
                        {{ old('category') === 'AC Technician' ? 'selected' : '' }}
                    >
                        AC Technician
                    </option>

                    <option
                        value="Locksmith"
                        {{ old('category') === 'Locksmith' ? 'selected' : '' }}
                    >
                        Locksmith
                    </option>

                    <option
                        value="Cleaner"
                        {{ old('category') === 'Cleaner' ? 'selected' : '' }}
                    >
                        Cleaner
                    </option>

                    <option
                        value="Carpenter"
                        {{ old('category') === 'Carpenter' ? 'selected' : '' }}
                    >
                        Carpenter
                    </option>

                </select>

            </div>



            <!-- EXPERIENCE -->

            <div class="spr-field">

                <label for="experience">
                    YEARS OF EXPERIENCE
                </label>

                <input
                    id="experience"
                    name="experience"
                    type="number"
                    min="0"
                    value="{{ old('experience') }}"
                    placeholder="e.g. 6"
                    required
                >

            </div>



            <!-- =========================================
                 SUBMIT
            ========================================== -->

            <button
                type="submit"
                class="spr-submit"
            >
                SUBMIT PROVIDER APPLICATION
            </button>


        </form>



        <!-- =========================================
             LOGIN
        ========================================== -->

        <p class="spr-login">

            <span>
                Already registered?
            </span>

            <a href="{{ route('login') }}">
                SIGN IN
            </a>

        </p>


    </div>

</section>

@endsection