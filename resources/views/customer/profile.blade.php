@extends('layouts.app')

@section('content')

<div class="customer-profile-page">

    <div class="customer-profile-container">


        <!-- =========================================
             PAGE HEADER
        ========================================== -->

        <div class="customer-profile-header">

            <div>

                <p class="customer-profile-eyebrow">
                    CLIENT PORTAL
                </p>

                <h1>
                    CUSTOMER PROFILE
                </h1>

                <strong class="customer-profile-name">{{ auth()->user()->name }}</strong>

            </div>


            <div class="customer-profile-id">
                CUSTOMER ID: SEH-{{ str_pad(auth()->user()->id, 4, '0', STR_PAD_LEFT) }}-C
</div>

        </div>



        <!-- =========================================
             ROW 1
        ========================================== -->

        <div class="customer-profile-grid">


            <!-- ACCOUNT INFORMATION -->

            <section class="customer-profile-card">

                <h2>
                    ACCOUNT INFORMATION
                </h2>


                <div class="customer-profile-field">

                    <label for="customerProfileName">
                        FULL NAME
                    </label>

                    <input
                            id="customerProfileName"
                            type="text"
                            value="{{ auth()->user()->name }}"
                            disabled
>

                </div>


                <div class="customer-profile-field">

                    <label for="customerProfileEmail">
                        EMAIL
                    </label>

                    <input
                        id="customerProfileEmail"
                        type="email"
                        value="{{ auth()->user()->email }}"
                        disabled
>

                </div>


                <div class="customer-profile-field">

                    <label for="customerProfilePhone">
                        PHONE NUMBER
                    </label>

                    <input
                        id="customerProfilePhone"
                        type="text"
                        value="{{ auth()->user()->phone }}"
                        disabled
                    >

                </div>


                <div class="customer-account-meta">

                    <div>

                        <span>
                            ACCOUNT STATUS
                        </span>

                        <strong class="customer-account-active">
    {{ auth()->user()->is_active ? 'ACTIVE' : 'INACTIVE' }}
</strong>

                    </div>


                    <div>

                        <span>
                            MEMBER SINCE
                        </span>

                        <strong>{{ auth()->user()->created_at->format('F Y') }}</strong>

                    </div>

                </div>

            </section>



            <!-- LOCATION -->

            <section class="customer-profile-card">

                <h2>
                    LOCATION
                </h2>


                <div class="customer-profile-field">

                    <label for="customerDefaultAddress">
                        DEFAULT ADDRESS
                    </label>

                   <input
                    id="customerDefaultAddress"
                    type="text"
                    value="{{ auth()->user()->address }}"
                    disabled
                >

                </div>


                <div class="customer-profile-field">

                    <label for="customerProfileArea">
                        AREA
                    </label>

            <select
                id="customerProfileArea"
                disabled>
            <option selected> {{ auth()->user()->area }}</option>
            </select>
                </div>


                <button
                    type="button"
                    id="updateLocationBtn"
                    class="customer-profile-outline-btn"
                    disabled
                >
                    UPDATE LOCATION
                </button>

            </section>

        </div>



        <!-- =========================================
             ROW 2
        ========================================== -->

        <div class="customer-profile-grid">


            <!-- EMERGENCY SETTINGS -->

            <section class="customer-profile-card emergency-settings-card">

                <h2>
                    EMERGENCY SETTINGS
                </h2>


                <div class="customer-profile-field">

                    <label for="defaultEmergencyContact">
                        DEFAULT EMERGENCY CONTACT
                    </label>

                   <select
                            id="defaultEmergencyContact"
                            disabled
                        >
                    <option selected>
                        {{ auth()->user()->emergency_email ?: 'No emergency contact email added' }}
                    </option>
               </select>

                </div>


                <div class="critical-notification-box">

                    <strong>
                        CRITICAL CONTACT NOTIFICATION
                    </strong>

                    <p>
                        Emails your emergency contact when a Critical request is dispatched.
                    </p>


                    <button
                        type="button"
                        id="criticalNotificationBtn"
                        class="critical-notification-btn active"
                        disabled
                    >
                        ENABLED
                    </button>

                </div>

            </section>



            <!-- SECURITY -->

            <section class="customer-profile-card security-card">

                <h2>
                    SECURITY
                </h2>


                <div class="customer-profile-field">

                    <label for="currentPassword">
                        CURRENT PASSWORD
                    </label>

                    <input
                        id="currentPassword"
                        type="password"
                    >

                </div>


                <div class="customer-profile-field">

                    <label for="newPassword">
                        NEW PASSWORD
                    </label>

                    <input
                        id="newPassword"
                        type="password"
                    >

                </div>


                <div class="customer-profile-field">

                    <label for="confirmNewPassword">
                        CONFIRM NEW PASSWORD
                    </label>

                    <input
                        id="confirmNewPassword"
                        type="password"
                    >

                </div>


                <button
                    type="button"
                    id="changePasswordBtn"
                    class="customer-profile-dark-btn"
                >
                    CHANGE PASSWORD
                </button>


                <div class="customer-session-box">

                    <span>
                        SESSION
                    </span>

                    <p>
                        Signed in on this device · Dhaka · Last activity today
                    </p>

                </div>

            </section>

        </div>



        <!-- =========================================
             PAGE ACTIONS
        ========================================== -->

        <div class="customer-profile-actions">


            <button
                type="button"
                id="editCustomerProfileBtn"
                class="customer-profile-outline-btn"
            >
                EDIT PROFILE
            </button>


            <button
                type="button"
                id="saveCustomerProfileBtn"
                class="customer-profile-dark-btn"
                disabled
            >
                SAVE CHANGES
            </button>


            <a
                href="{{ route('customer.dashboard') }}"
                class="customer-profile-back-link"
            >
                BACK TO CUSTOMER DASHBOARD
            </a>

        </div>


    </div>

</div>

@endsection