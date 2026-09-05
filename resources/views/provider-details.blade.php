@extends('layouts.app')

@section('content')

<div class="public-provider-profile">

    <div class="public-provider-container">


        <!-- =====================================================
             HERO
        ====================================================== -->

        <section class="public-provider-hero">

            <div class="public-provider-hero-left">

                <p class="public-provider-eyebrow">
                    PROVIDER PROFILE · {{ $provider['id'] }}
                </p>

                <h1>
                    {{ strtoupper($provider['name']) }}
                </h1>

                <p class="public-provider-description">
                    {{ $provider['description'] }}
                </p>

            </div>


            <div class="public-provider-hero-actions">

                <a
                    href="{{ route('emergency.request') }}"
                    class="public-provider-request-btn"
                >
                    REQUEST THIS SERVICE
                </a>

                <a
                    href="{{ route('providers') }}"
                    class="public-provider-back-btn"
                >
                    BACK TO DIRECTORY
                </a>

            </div>

        </section>



        <!-- =====================================================
             BADGES
        ====================================================== -->

        <div class="public-provider-badges">

            <span class="pp-available">
                {{ strtoupper($provider['availability']) }}
            </span>

            <span class="pp-verified">
                VERIFIED PROVIDER
            </span>

            <span class="pp-category">
                {{ strtoupper($provider['category']) }}
            </span>

            <span class="pp-trusted">
                {{ strtoupper($provider['trust_level']) }}
            </span>

        </div>



        <!-- =====================================================
             METRIC CARDS
        ====================================================== -->

        <section class="public-provider-metrics">


            <div class="public-provider-metric">

                <span>
                    RECOMMENDATION SCORE
                </span>

                <strong class="pp-red">
                    {{ $provider['score'] }}
                </strong>

                <p>
                    Distance 40 · availability 25 · rating 20 · experience 15
                </p>

            </div>



            <div class="public-provider-metric">

                <span>
                    AVERAGE RATING
                </span>

                <strong>
                    {{ $provider['rating'] }}
                </strong>

                <p>
                    {{ $provider['completed_jobs'] }} completed services
                </p>

            </div>



            <div class="public-provider-metric">

                <span>
                    DISTANCE
                </span>

                <strong class="pp-blue">
                    {{ $provider['distance'] }}
                </strong>

                <p>
                    Zone: {{ $provider['area'] }}
                </p>

            </div>



            <div class="public-provider-metric">

                <span>
                    EXPERIENCE
                </span>

                <strong>
                    {{ $provider['experience'] }}
                </strong>

                <p>
                    On platform since {{ $provider['platform_since'] }}
                </p>

            </div>



            <div class="public-provider-metric">

                <span>
                    COMPLETED JOBS
                </span>

                <strong>
                    {{ $provider['completed_jobs'] }}
                </strong>

                <p>
                    Frontend demo data
                </p>

            </div>



            <div class="public-provider-metric">

                <span>
                    RULE-BASED TRUST SCORE
                </span>

                <strong class="pp-blue">
                    {{ $provider['trust_score'] }} / 100
                </strong>

                <p>
                    {{ $provider['trust_level'] }}
                </p>

            </div>


        </section>



        <!-- =====================================================
             MAIN CONTENT GRID
        ====================================================== -->

        <div class="public-provider-main-grid">


            <!-- =================================================
                 LEFT
            ================================================== -->

            <div class="public-provider-left">


                <!-- COVERAGE -->

                <section class="public-provider-section">

                    <p class="public-provider-label">
                        SERVICE COVERAGE
                    </p>

                    <h2>
                        COVERAGE & RESPONSE
                    </h2>


                    <div class="public-provider-coverage-grid">


                        <div>

                            <span>
                                PRIMARY CATEGORY
                            </span>

                            <strong>
                                {{ $provider['category'] }}
                            </strong>

                        </div>


                        <div>

                            <span>
                                BASE ZONE
                            </span>

                            <strong>
                                {{ $provider['area'] }}, Dhaka
                            </strong>

                        </div>


                        <div>

                            <span>
                                CONTACT
                            </span>

                            <strong>
                                {{ $provider['phone'] }}
                            </strong>

                        </div>


                        <div>

                            <span>
                                TRUST LEVEL
                            </span>

                            <strong>
                                {{ $provider['trust_level'] }}
                            </strong>

                        </div>


                    </div>



                    <div class="public-provider-dispatch-box">

                        <strong>
                            HOW DISPATCH WORKS
                        </strong>

                        <p>
                            When an emergency request matches this category,
                            the platform ranks nearby verified providers and
                            offers the request to the highest scoring available
                            provider first. If it is declined or not accepted
                            in time, the request moves to the next provider.
                        </p>

                    </div>

                </section>



                <!-- VERIFICATION -->

                <section class="public-provider-section">

                    <p class="public-provider-label">
                        TRUST VERIFICATION
                    </p>

                    <h2>
                        MULTI-STEP CHECKS PASSED
                    </h2>


                    <div class="public-provider-check-grid">


                        <div class="public-provider-check">

                            <span>✓</span>

                            <strong>
                                Phone Ownership Verified
                            </strong>

                        </div>


                        <div class="public-provider-check">

                            <span>✓</span>

                            <strong>
                                Admin Approved
                            </strong>

                        </div>


                        <div class="public-provider-check">

                            <span>✓</span>

                            <strong>
                                Service Category Approved
                            </strong>

                        </div>


                    </div>

                </section>



                <!-- SAFETY -->

                <section class="public-provider-section">

                    <p class="public-provider-label">
                        SERVICE SAFETY
                    </p>

                    <h2>
                        ARRIVAL TO COMPLETION CHAIN
                    </h2>


                    <div class="public-provider-safety-list">


                        <div class="public-provider-safety-row">

                            <span>01</span>

                            <div>

                                <strong>
                                    Arrival PIN
                                </strong>

                                <p>
                                    Shared only when the provider physically reaches you.
                                </p>

                            </div>

                        </div>



                        <div class="public-provider-safety-row">

                            <span>02</span>

                            <div>

                                <strong>
                                    Before Photo
                                </strong>

                                <p>
                                    Uploaded by the provider before the service begins.
                                </p>

                            </div>

                        </div>



                        <div class="public-provider-safety-row">

                            <span>03</span>

                            <div>

                                <strong>
                                    Working
                                </strong>

                                <p>
                                    The active service stage remains visible to the customer.
                                </p>

                            </div>

                        </div>



                        <div class="public-provider-safety-row">

                            <span>04</span>

                            <div>

                                <strong>
                                    After Photo
                                </strong>

                                <p>
                                    Uploaded once the provider completes the service.
                                </p>

                            </div>

                        </div>



                        <div class="public-provider-safety-row">

                            <span>05</span>

                            <div>

                                <strong>
                                    Completion PIN
                                </strong>

                                <p>
                                    Final customer confirmation before completion.
                                </p>

                            </div>

                        </div>


                    </div>

                </section>


            </div>



            <!-- =================================================
                 RIGHT - FEEDBACK
            ================================================== -->

            <aside class="public-provider-feedback">

                <p class="public-provider-label">
                    RATINGS & REVIEWS
                </p>

                <h2>
                    CUSTOMER FEEDBACK
                </h2>



                @foreach($provider['reviews'] as $review)

                    <div class="public-provider-review">

                        <div class="public-provider-review-head">

                            <strong>
                                {{ $review['name'] }}
                            </strong>

                            <span>
                                {{ $review['stars'] }}
                            </span>

                        </div>

                        <p>
                            {{ $review['text'] }}
                        </p>

                    </div>

                @endforeach


            </aside>


        </div>


    </div>

</div>

@endsection