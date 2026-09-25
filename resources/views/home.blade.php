@extends('layouts.app')

@section('title', 'Smart Emergency Helper')

@section('content')

<div class="home-wrapper">
    <!-- HERO SECTION (WHITE THEME) -->
    <section class="home-hero-section">
        <div class="home-hero-container">
            <div>
                <h1 class="home-hero-title">
                    Emergency response,<br>
                    <span>re-engineered for trust.</span>
                </h1>
                <p class="home-hero-desc">
                    Request verified ambulance, home nurse, blood donors, electricians, and technicians. Real-time dispatch, 5-step transparent workflow, and two-way Arrival &amp; Completion PIN confirmation.
                </p>
                <div class="home-hero-actions">
                    <a href="{{ route('emergency.form') }}" class="btn-emergency-hero">
                        REQUEST EMERGENCY
                    </a>
                    <a href="{{ route('provider.register') }}" class="btn-provider-hero">
                        REGISTER AS PROVIDER
                    </a>
                </div>
            </div>

            <div>
                <div class="home-hero-card">
                    <img src="{{ asset('images/emergency-city.png') }}" alt="Dhaka Emergency City Response" class="home-hero-card-img" onerror="this.onerror=null; this.src='{{ asset('images/ambulanceprovider1.jpg') }}';">
                    <div class="home-hero-pill-grid">
                        <div class="hero-mini-pill">Verified Providers</div>
                        <div class="hero-mini-pill">Priority Dispatch</div>
                        <div class="hero-mini-pill">Arrival PIN</div>
                        <div class="hero-mini-pill">Completion PIN</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TRUST STRIP -->
    <section class="trust-strip">
        <div class="trust-strip-container">
            <div class="trust-strip-item">
                <div><strong>PHONE OTP</strong><br><small style="color:#64748b; font-size:9.5px;">Verified Responders</small></div>
            </div>
            <div class="trust-strip-item">
                <div><strong>WEIGHTED RANK</strong><br><small style="color:#64748b; font-size:9.5px;">Distance &amp; Rating</small></div>
            </div>
            <div class="trust-strip-item">
                <div><strong>ADMIN APPROVED</strong><br><small style="color:#64748b; font-size:9.5px;">Vetted Specialists</small></div>
            </div>
            <div class="trust-strip-item">
                <div><strong>TWO-WAY PINS</strong><br><small style="color:#64748b; font-size:9.5px;">Client-Controlled</small></div>
            </div>
        </div>
    </section>

    <!-- SERVICES NETWORK SECTION -->
    <section class="home-services-section">
        <div class="section-header-row">
            <div>
                <div class="section-tag">COORDINATED DISPATCH</div>
                <h2 class="section-heading-main">Emergency, Technical &amp; Home Services</h2>
            </div>
            <a href="{{ route('services') }}" class="service-action-link">VIEW ALL SERVICES &rarr;</a>
        </div>

        <div class="services-card-grid">
            <!-- 1. AMBULANCE -->
            <div class="home-service-card">
                <div>
                    <div class="card-top-tag">
                        <span class="badge-service-crit">CRITICAL</span>
                    </div>
                    <h3>Ambulance Service</h3>
                    <p>Rapid emergency medical transport to the nearest Dhaka hospital with life support equipment.</p>
                </div>
                <a href="{{ route('emergency.form') }}" class="service-action-link">Request Ambulance &rarr;</a>
            </div>

            <!-- 2. HOME NURSE -->
            <div class="home-service-card">
                <div>
                    <div class="card-top-tag">
                        <span class="badge-service-high">HIGH</span>
                    </div>
                    <h3>Home Nurse</h3>
                    <p>Post-operative nursing, wound dressing, patient monitoring, and in-home injections.</p>
                </div>
                <a href="{{ route('emergency.form') }}" class="service-action-link">Request Home Nurse &rarr;</a>
            </div>

            <!-- 3. BLOOD DONOR -->
            <div class="home-service-card">
                <div>
                    <div class="card-top-tag">
                        <span class="badge-service-crit">CRITICAL</span>
                    </div>
                    <h3>Blood Donor</h3>
                    <p>Direct matched blood donor coordination across Dhaka blood banks and verified donors.</p>
                </div>
                <a href="{{ route('emergency.form') }}" class="service-action-link">Find Blood Donor &rarr;</a>
            </div>

            <!-- 4. ELECTRICIAN -->
            <div class="home-service-card">
                <div>
                    <div class="card-top-tag">
                        <span class="badge-service-high">HIGH</span>
                    </div>
                    <h3>Electrician</h3>
                    <p>Short circuit diagnosis, power failure repair, circuit breaker troubleshooting, and wiring.</p>
                </div>
                <a href="{{ route('emergency.form') }}" class="service-action-link">Dispatch Electrician &rarr;</a>
            </div>

            <!-- 5. PLUMBER -->
            <div class="home-service-card">
                <div>
                    <div class="card-top-tag">
                        <span class="badge-service-high">HIGH</span>
                    </div>
                    <h3>Plumber</h3>
                    <p>Burst pipe control, emergency water leakage, drain cleaning, and water pump repair.</p>
                </div>
                <a href="{{ route('emergency.form') }}" class="service-action-link">Dispatch Plumber &rarr;</a>
            </div>

            <!-- 6. AC TECHNICIAN -->
            <div class="home-service-card">
                <div>
                    <div class="card-top-tag">
                        <span class="badge-service-norm">MEDIUM</span>
                    </div>
                    <h3>AC Technician</h3>
                    <p>Compressor repair, gas refill, electrical faults, and emergency cooling maintenance.</p>
                </div>
                <a href="{{ route('emergency.form') }}" class="service-action-link">Request AC Tech &rarr;</a>
            </div>

            <!-- 7. CLEANER -->
            <div class="home-service-card">
                <div>
                    <div class="card-top-tag">
                        <span class="badge-service-norm">NORMAL</span>
                    </div>
                    <h3>Cleaner</h3>
                    <p>Sanitization, post-incident cleanup, and thorough residential cleaning assistance.</p>
                </div>
                <a href="{{ route('emergency.form') }}" class="service-action-link">Request Cleaner &rarr;</a>
            </div>

            <!-- 8. CARPENTER -->
            <div class="home-service-card">
                <div>
                    <div class="card-top-tag">
                        <span class="badge-service-norm">NORMAL</span>
                    </div>
                    <h3>Carpenter</h3>
                    <p>Door, window, lock fitting, and emergency woodwork repair for residential homes.</p>
                </div>
                <a href="{{ route('emergency.form') }}" class="service-action-link">Request Carpenter &rarr;</a>
            </div>
        </div>
    </section>

    <!-- 5 OPERATIONAL STEPS -->
    <section class="how-section">
        <div class="how-container">
            <div class="section-tag">TRANSPARENT LIFECYCLE</div>
            <h2 class="section-heading-main">5 Steps from Request to Confirmed Completion</h2>

            <div class="steps-horizontal-grid">
                <div class="how-step-card">
                    <div class="how-step-number">01</div>
                    <div class="how-step-title">PENDING</div>
                    <div class="how-step-desc">Customer dispatches request with location &amp; priority.</div>
                </div>
                <div class="how-step-card">
                    <div class="how-step-number">02</div>
                    <div class="how-step-title">ACCEPTED</div>
                    <div class="how-step-desc">Nearest verified helper accepts the mission alert.</div>
                </div>
                <div class="how-step-card">
                    <div class="how-step-number">03</div>
                    <div class="how-step-title">ON THE WAY</div>
                    <div class="how-step-desc">Responder is en route directly to customer location.</div>
                </div>
                <div class="how-step-card">
                    <div class="how-step-number">04</div>
                    <div class="how-step-title">ARRIVAL PIN</div>
                    <div class="how-step-desc">Customer verifies 4-digit PIN upon arrival at site.</div>
                </div>
                <div class="how-step-card">
                    <div class="how-step-number">05</div>
                    <div class="how-step-title">COMPLETION PIN</div>
                    <div class="how-step-desc">Job confirmed done, Completion PIN entered, Cash paid.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- SPLIT FEATURE: RECOMMENDATION & VERIFICATION -->
    <section class="split-feature-section">
        <div class="feature-box">
            <div class="section-tag">SMART DISPATCH</div>
            <h3>Intelligent Provider Ranking</h3>
            <p>Every nearby provider is scored against an auditable formula based on distance, availability, and user rating:</p>
            <div class="weight-meter-list">
                <div class="weight-row">
                    <span>Distance to Customer</span>
                    <div class="weight-bar-bg"><div class="weight-bar-fill" style="width: 40%;"></div></div>
                    <span>40%</span>
                </div>
                <div class="weight-row">
                    <span>Live Availability</span>
                    <div class="weight-bar-bg"><div class="weight-bar-fill" style="width: 25%;"></div></div>
                    <span>25%</span>
                </div>
                <div class="weight-row">
                    <span>Rating &amp; Reviews</span>
                    <div class="weight-bar-bg"><div class="weight-bar-fill" style="width: 20%;"></div></div>
                    <span>20%</span>
                </div>
                <div class="weight-row">
                    <span>Experience Years</span>
                    <div class="weight-bar-bg"><div class="weight-bar-fill" style="width: 15%;"></div></div>
                    <span>15%</span>
                </div>
            </div>
        </div>

        <div class="feature-box">
            <div class="section-tag">SAFETY &amp; DISPATCH</div>
            <h3>Provider Verification Standard</h3>
            <p>Responders undergo phone OTP verification and administrator review before receiving emergency requests.</p>
            <div style="display:flex; flex-direction:column; gap:10px; font-size:11.5px; color:#334155;">
                <div><strong>Phone OTP:</strong> Direct ownership confirmation of mobile number.</div>
                <div><strong>Admin Review:</strong> Profile and service capability verified manually.</div>
                <div><strong>Two-Way PIN:</strong> Dual safety PIN at start &amp; finish ensures trust.</div>
            </div>
        </div>
    </section>


</div>

@endsection