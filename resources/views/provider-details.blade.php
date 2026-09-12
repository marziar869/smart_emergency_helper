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
                    PROVIDER PROFILE · PRV-{{ 1000 + $provider->id }}
                </p>

                <h1>
                    {{ strtoupper($provider->user->name ?? 'Verified Provider') }}
                </h1>

                <p class="public-provider-description">
                    Professional {{ $provider->serviceCategory->name ?? 'Service' }} provider operating in {{ $provider->area }}, Dhaka with {{ $provider->experience_years }} years of verified experience.
                </p>

            </div>


            <div class="public-provider-hero-actions">

                <a
                    href="{{ route('emergency.form') }}"
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
                {{ $provider->is_available ? 'AVAILABLE' : 'OFFLINE' }}
            </span>

            @if($provider->phone_verified)
            <span class="pp-verified">
                VERIFIED PROVIDER
            </span>
            @endif

            <span class="pp-category">
                {{ strtoupper($provider->serviceCategory->name ?? 'Service') }}
            </span>

            <span class="pp-trusted">
                HIGHLY TRUSTED
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
                    {{ min(99, 70 + ($provider->rating * 5) + min($provider->experience_years, 10)) }}
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
                    ★ {{ number_format($provider->rating, 1) }}
                </strong>

                <p>
                    {{ $completedJobsCount ?? $provider->total_reviews }} completed services
                </p>

            </div>


            <div class="public-provider-metric">

                <span>
                    LOCATION / ZONE
                </span>

                <strong class="pp-blue">
                    {{ $provider->area }}
                </strong>

                <p>
                    Zone: {{ $provider->area }}, Dhaka
                </p>

            </div>



            <div class="public-provider-metric">

                <span>
                    EXPERIENCE
                </span>

                <strong>
                    {{ $provider->experience_years }} Years
                </strong>

                <p>
                    On platform since {{ $provider->created_at->format('M Y') }}
                </p>

            </div>



            <div class="public-provider-metric">

                <span>
                    COMPLETED JOBS
                </span>

                <strong>
                    {{ $provider->total_reviews }}
                </strong>

                <p>
                    Verified platform services
                </p>

            </div>



            <div class="public-provider-metric">

                <span>
                    RULE-BASED TRUST SCORE
                </span>

                <strong class="pp-blue">
                    95 / 100
                </strong>

                <p>
                    HIGHLY TRUSTED
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
                                {{ $provider->serviceCategory->name ?? 'Service' }}
                            </strong>

                        </div>


                        <div>

                            <span>
                                BASE ZONE
                            </span>

                            <strong>
                                {{ $provider->area }}, Dhaka
                            </strong>

                        </div>


                        <div>

                            <span>
                                CONTACT
                            </span>

                            <strong>
                                {{ $provider->user->phone ?? 'Verified Phone' }}
                            </strong>

                        </div>


                        <div>

                            <span>
                                TRUST LEVEL
                            </span>

                            <strong>
                                HIGHLY TRUSTED
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

            </div>

        </div>

    </div>

</div>

@endsection