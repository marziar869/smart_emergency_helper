@extends('layouts.app')

@section('content')

<section class="scr-customer-register">

    <div class="scr-register-card">

        <!-- SMALL TOP LABEL -->
        <div class="scr-register-eyebrow">
            CUSTOMER REGISTRATION
        </div>

        <!-- MAIN TITLE -->
        <h1 class="scr-register-title">
            CREATE A CUSTOMER ACCOUNT
        </h1>

        <!-- DESCRIPTION -->
        <p class="scr-register-description">
            Register once, then submit emergency requests with priority, Dhaka area and description
            details.
        </p>
        @if ($errors->any())
    <div style="background:#ffe5e5; border:1px solid #e11; padding:15px; margin:15px 0; color:#900;">
        <strong>Registration failed:</strong>

        <ul style="margin:10px 0 0 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


        <!-- ACCOUNT TYPE -->
        <div class="scr-account-types">

            <a href="{{ route('customer.register') }}"
               class="scr-account-type scr-account-type-active">
                CUSTOMER
            </a>

            <a href="{{ route('provider.register') }}"
               class="scr-account-type scr-provider-type">
                SERVICE PROVIDER
            </a>

        </div>


        <!-- REGISTRATION FORM -->
        <form class="scr-register-form" method="POST" action="{{ route('customer.register.submit') }}">

            @csrf


            <!-- ROW 1 -->
            <!-- FULL NAME -->
            <div class="scr-field">

                <label for="full_name">
                    FULL NAME
                </label>

                <input
                    id="full_name"
                    name="full_name"
                    type="text"
                    placeholder="e.g. Md. Arif Hossain"
                >

            </div>


            <!-- PHONE NUMBER -->
            <div class="scr-field">

                <label for="phone">
                    PHONE NUMBER
                </label>

                <input
                    id="phone"
                    name="phone"
                    type="text"
                    placeholder="+880 17XX-XXXXXX"
                >

            </div>



            <!-- ROW 2 -->
            <!-- EMAIL - FULL WIDTH -->
            <div class="scr-field scr-field-full">

                <label for="email">
                    EMAIL
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="you@example.com"
                >

            </div>



            <!-- ROW 3 -->
            <!-- PASSWORD -->
            <div class="scr-field">

                <label for="password">
                    PASSWORD
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="••••••••"
                >

            </div>


            <!-- CONFIRM PASSWORD -->
            <div class="scr-field">

                <label for="password_confirmation">
                    CONFIRM PASSWORD
                </label>

                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    placeholder="••••••••"
                >

            </div>



            <!-- ROW 4 -->
            <!-- DEFAULT DHAKA AREA -->
            <div class="scr-field">

                <label for="area">
                    DEFAULT DHAKA AREA
                </label>

                <select id="area" name="area">

                    <option value="Dhanmondi">
                        Dhanmondi
                    </option>

                    <option value="Gulshan">
                        Gulshan
                    </option>

                    <option value="Banani">
                        Banani
                    </option>

                    <option value="Uttara">
                        Uttara
                    </option>

                    <option value="Mirpur">
                        Mirpur
                    </option>

                    <option value="Bashundhara">
                        Bashundhara
                    </option>

                    <option value="Badda">
                        Badda
                    </option>

                </select>

            </div>


            <!-- DETAILED ADDRESS -->
            <div class="scr-field">

                <label for="address">
                    DETAILED ADDRESS
                </label>

                <input
                    id="address"
                    name="address"
                    type="text"
                    placeholder="e.g. Road 8A, House 42"
                >

            </div>



            <!-- ROW 5 -->
            <!-- EMERGENCY EMAIL - FULL WIDTH -->
            <div class="scr-field scr-field-full">

                <label for="emergency_email">
                    EMERGENCY CONTACT EMAIL (OPTIONAL)
                </label>

                <input
                    id="emergency_email"
                    name="emergency_email"
                    type="email"
                    placeholder="notified automatically on critical requests"
                >

            </div>



            <!-- CREATE ACCOUNT BUTTON -->
            <button
                type="submit"
                class="scr-create-account-btn"
            >
                CREATE CUSTOMER ACCOUNT
            </button>


        </form>


        <!-- SIGN IN -->
        <p class="scr-register-login">

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