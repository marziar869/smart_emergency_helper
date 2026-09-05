@extends('layouts.app')

@section('content')

<div class="provider-review-page">

    <div class="provider-review-container">


        <!-- =====================================================
             HEADER
        ====================================================== -->

        <div class="provider-review-header">

            <div>

                <p class="provider-review-eyebrow">
                    ADMIN CONTROL
                </p>

                <h1>
                    PROVIDER VERIFICATION REVIEW
                </h1>

                <p class="provider-review-subtitle">

                    {{ $provider['name'] }}
                    ·
                    {{ $providerId }}
                    ·
                    {{ $provider['category'] }}
                    ·
                    Submitted {{ $provider['submitted'] }}

                </p>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="provider-back-link"
                >
                    ← BACK TO DASHBOARD
                </a>

            </div>


            <div
                id="providerReviewStatus"
                class="provider-review-status status-under-review"
            >
                UNDER REVIEW
            </div>

        </div>



        <!-- =====================================================
             ROW 1
        ====================================================== -->

        <div class="provider-review-grid">


            <!-- PHONE OWNERSHIP -->

            <section class="provider-review-card">

                <h3>
                    PHONE OWNERSHIP
                </h3>

                <p class="provider-phone">

                    Phone:

                    <strong>
                        {{ $provider['phone'] }}
                    </strong>

                </p>

                <span class="provider-verified-text">
                    OTP VERIFIED
                </span>

            </section>



            <!-- REGISTRATION -->

            <section class="provider-review-card">

                <h3>
                    REGISTRATION
                </h3>

                <p class="provider-registration-date">

                    Registered:

                    <strong>
                        {{ $provider['created'] }}
                    </strong>

                </p>

                <p class="provider-card-note">
                    Verification is limited to phone ownership and a manual
                    profile review. No national ID or government database
                    check is used.
                </p>

            </section>


        </div>



        <!-- =====================================================
             ROW 2
        ====================================================== -->

        <div class="provider-review-grid">


            <!-- ADMIN REVIEW CHECKLIST -->

            <section class="provider-review-card checklist-card">

                <h3>
                    ADMIN REVIEW CHECKLIST
                </h3>


                <label class="provider-check-row">

                    <input
                        type="checkbox"
                        class="provider-review-check"
                    >

                    <span>
                        Phone OTP successfully verified
                    </span>

                </label>


                <label class="provider-check-row">

                    <input
                        type="checkbox"
                        class="provider-review-check"
                    >

                    <span>
                        Provider profile information is acceptable
                    </span>

                </label>


                <label class="provider-check-row">

                    <input
                        type="checkbox"
                        class="provider-review-check"
                    >

                    <span>
                        Service category information is acceptable
                    </span>

                </label>

            </section>



            <!-- PROVIDER INFORMATION -->

            <section class="provider-review-card">

                <h3>
                    PROVIDER INFORMATION
                </h3>


                <div class="provider-info-grid">


                    <div>

                        <span>
                            NAME
                        </span>

                        <strong>
                            {{ $provider['name'] }}
                        </strong>

                    </div>



                    <div>

                        <span>
                            PHONE
                        </span>

                        <strong>
                            {{ $provider['phone'] }}
                        </strong>

                    </div>



                    <div>

                        <span>
                            EMAIL
                        </span>

                        <strong>
                            {{ $provider['email'] }}
                        </strong>

                    </div>



                    <div>

                        <span>
                            SERVICE CATEGORY
                        </span>

                        <strong>
                            {{ $provider['category'] }}
                        </strong>

                    </div>



                    <div>

                        <span>
                            EXPERIENCE
                        </span>

                        <strong>
                            {{ $provider['experience'] }}
                        </strong>

                    </div>



                    <div>

                        <span>
                            SERVICE AREA
                        </span>

                        <strong>
                            {{ $provider['area'] }}
                        </strong>

                    </div>



                    <div>

                        <span>
                            ACCOUNT CREATED
                        </span>

                        <strong>
                            {{ $provider['created'] }}
                        </strong>

                    </div>


                </div>

            </section>


        </div>



        <!-- =====================================================
             ADMIN NOTE
        ====================================================== -->

        <section class="provider-review-card provider-note-card">

            <h3>
                ADMIN NOTE
            </h3>

            <textarea
                id="providerAdminNote"
                placeholder="Add internal verification note..."
            ></textarea>

        </section>



        <!-- =====================================================
             ACTION BUTTONS
        ====================================================== -->

        <div class="provider-review-actions">


            <button
                type="button"
                id="approveProviderBtn"
                class="provider-action-btn approve-provider-btn"
                disabled
            >
                APPROVE PROVIDER
            </button>


            <button
                type="button"
                id="requestCorrectionBtn"
                class="provider-action-btn correction-provider-btn"
            >
                REQUEST CORRECTION
            </button>


            <button
                type="button"
                id="rejectProviderBtn"
                class="provider-action-btn reject-provider-btn"
            >
                REJECT PROVIDER
            </button>


        </div>


        <p class="provider-review-footer-note">
            Only providers marked Approved receive Verified Provider status
            and become eligible to receive service requests.
        </p>


    </div>

</div>

@endsection