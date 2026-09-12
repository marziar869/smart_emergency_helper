@extends('layouts.app')


@section('content')


<!-- ================= HERO SECTION ================= -->

<section class="hero-section">


<div class="hero-container">


    <!-- LEFT CONTENT -->

    <div class="hero-content">


        <span class="section-label">
            PRIORITY-BASED EMERGENCY RESPONSE
        </span>



        <h1>
            Emergency<br>
            response, <span>re-engineered<br>
            for trust.</span>
        </h1>



        <p>
            Request verified emergency, technical and home
            assistance through priority-based dispatch,
            intelligent provider recommendation and
            customer-controlled service confirmation.
        </p>




        <div class="hero-buttons">


          <a href="{{ route('request.emergency') }}" class="btn-primary">
        REQUEST EMERGENCY
    </a>

    <a href="{{ route('provider.register') }}" class="btn-secondary">
        REGISTER AS PROVIDER
    </a>

        </div>



    </div>






    <!-- RIGHT IMAGE -->

    <div class="hero-image-area">



        <img 
        src="{{ asset('images/emergency-city.png.png') }}"
        class="hero-image"
        alt="Emergency City">





        <!-- IMAGE FEATURE BAR -->


        <div class="hero-feature-bar">


            <div>
                VERIFIED<br>
                PROVIDERS
            </div>



            <div>
                PRIORITY<br>
                DISPATCH
            </div>



            <div>
                ARRIVAL PIN
            </div>



            <div>
                COMPLETION PIN
            </div>


        </div>



    </div>




</div>


</section>









<!-- ================= TRUST FEATURES ================= -->


<section class="trust-feature-section">


<div class="trust-feature-container">



    <div class="trust-box">


        <i class="bi bi-telephone"></i>


        <p>
            PHONE OTP VERIFIED
        </p>


    </div>






    <div class="trust-box">


        <i class="bi bi-shield-check"></i>


        <p>
            WEIGHTED RECOMMENDATION
        </p>


    </div>






    <div class="trust-box">


        <i class="bi bi-shield-fill-check"></i>


        <p>
            ADMIN APPROVED PROVIDERS
        </p>


    </div>






    <div class="trust-box">


        <i class="bi bi-key"></i>


        <p>
            CUSTOMER-CONTROLLED COMPLETION
        </p>


    </div>



</div>


</section>









<!-- ================= SERVICE NETWORK ================= -->


<section class="service-intro">



<div class="service-heading">


    <span class="section-label">
        SERVICE NETWORK
    </span>



    <h2>
        Emergency and home<br>
        assistance in one<br>
        coordinated system.
    </h2>


</div>





</section>






<section class="services-section">



<!-- EMERGENCY SERVICES -->


<div class="service-group">



<div class="group-title emergency-title">

<span>
EMERGENCY SERVICES
</span>

<div class="vertical-count">
3 VERTICALS
</div>

</div>
<!-- ================= EMERGENCY SERVICE CARDS ================= -->


<div class="service-grid">



<div class="service-card">


<h3>
AMBULANCE
</h3>


<p>
Life-support transport to the nearest capable hospital.
</p>


<div class="priority critical">
CRITICAL
</div>


<span>
RESPONSE 8–15 MIN
</span>


<a href="#">
VIEW SERVICE
</a>


</div>







<div class="service-card">


<h3>
BLOOD DONOR
</h3>


<p>
Matched donor coordination for transfusion requests.
</p>


<div class="priority critical">
CRITICAL
</div>


<span>
RESPONSE 15–40 MIN
</span>


<a href="#">
VIEW SERVICE
</a>


</div>







<div class="service-card">


<h3>
HOME NURSE
</h3>


<p>
Post-operative care, wound dressing and monitoring.
</p>


<div class="priority high">
HIGH
</div>


<span>
RESPONSE 30–60 MIN
</span>


<a href="#">
VIEW SERVICE
</a>


</div>



</div>


</div>








<!-- ================= TECHNICAL SERVICES ================= -->


<div class="service-group">



<div class="group-title technical-title">

<span>
TECHNICAL SERVICES
</span>

<div class="vertical-count">
4 VERTICALS
</div>

</div>



<div class="service-grid four">





<div class="service-card">


<h3>
ELECTRICIAN
</h3>


<p>
Short circuits, board faults, power restoration.
</p>


<div class="priority high">
HIGH
</div>


<span>
RESPONSE 25–45 MIN
</span>


<a href="#">
VIEW SERVICE
</a>


</div>







<div class="service-card">


<h3>
PLUMBER
</h3>


<p>
Burst mains, leaks, drainage and pump failure.
</p>


<div class="priority high">
HIGH
</div>


<span>
RESPONSE 30–60 MIN
</span>


<a href="#">
VIEW SERVICE
</a>


</div>







<div class="service-card">


<h3>
AC TECHNICIAN
</h3>


<p>
Compressor failure, gas refill, HVAC diagnostics.
</p>


<div class="priority medium">
MEDIUM
</div>


<span>
RESPONSE 45–90 MIN
</span>


<a href="#">
VIEW SERVICE
</a>


</div>







<div class="service-card">


<h3>
LOCKSMITH
</h3>


<p>
Non-destructive entry and lock replacement.
</p>


<div class="priority high">
HIGH
</div>


<span>
RESPONSE 20–45 MIN
</span>


<a href="#">
VIEW SERVICE
</a>


</div>



</div>


</div>









<!-- ================= HOME SERVICES ================= -->


<div class="service-group">



<div class="group-title home-title">

<span>
HOME SERVICES
</span>

<div class="vertical-count">
2 VERTICALS
</div>

</div>







<div class="service-grid">





<div class="service-card">


<h3>
CLEANER
</h3>


<p>
Deep cleaning and post-incident clean-up.
</p>


<div class="priority normal">
NORMAL
</div>


<span>
RESPONSE SAME DAY
</span>


<a href="#">
VIEW SERVICE
</a>


</div>








<div class="service-card">


<h3>
CARPENTER
</h3>


<p>
Door, window and furniture repair.
</p>


<div class="priority normal">
NORMAL
</div>


<span>
RESPONSE SAME DAY
</span>


<a href="#">
VIEW SERVICE
</a>


</div>



</div>


</div>








<!-- ================= VIEW ALL ================= -->


<div class="view-all-area">


<a href="#" class="btn-outline">

VIEW ALL SERVICES

</a>


</div>





</section>
<!-- ================= HOW IT WORKS ================= -->


<section class="how-it-works">


<div class="section-container">



<span class="section-label">
HOW IT WORKS
</span>





<h2>

Five operational<br>
steps from request to<br>
confirmed completion.

</h2>






<div class="steps-list">





<div class="step-row">


<div class="step-number">
01
</div>



<div class="step-title">
CREATE REQUEST
</div>



<div class="step-description">

Customer selects service, priority, address and problem details.

</div>



</div>









<div class="step-row">


<div class="step-number">
02
</div>



<div class="step-title">
PROVIDER RECOMMENDATION
</div>



<div class="step-description">

The system ranks eligible providers using availability, rating, experience and service area.

</div>



</div>









<div class="step-row">


<div class="step-number">
03
</div>



<div class="step-title">
AUTOMATIC BROADCAST
</div>



<div class="step-description">

The request moves to the next suitable provider if the first provider rejects or times out.

</div>



</div>









<div class="step-row">


<div class="step-number">
04
</div>



<div class="step-title">
ARRIVAL VERIFICATION
</div>



<div class="step-description">

The provider enters the customer's Arrival PIN before starting the service.

</div>



</div>









<div class="step-row">


<div class="step-number">
05
</div>



<div class="step-title">
COMPLETION CONFIRMATION
</div>



<div class="step-description">

The provider uploads after-service evidence and enters the Completion PIN.

</div>



</div>





</div>





</div>


</section>









<!-- ================= PROVIDER VERIFICATION ================= -->



<section class="provider-verification">


<div class="section-container">





<span class="section-label">

PROVIDER VERIFICATION

</span>






<h2>

Providers are verified before<br>
they enter the response network.

</h2>








<div class="verification-grid">





<div class="verification-card">


<div class="verify-icon">

<i class="bi bi-telephone"></i>

</div>



<span>
01
</span>



<h4>
PHONE OTP
</h4>



<p>
One-time code sent to the registered number.
</p>



</div>









<div class="verification-card">


<div class="verify-icon">

<i class="bi bi-clipboard-check"></i>

</div>



<span>
02
</span>



<h4>
ADMIN REVIEW
</h4>



<p>
Provider profile and service information are reviewed manually.
</p>



</div>









<div class="verification-card">


<div class="verify-icon">

<i class="bi bi-person-check"></i>

</div>



<span>
03
</span>



<h4>
PROFILE APPROVAL
</h4>



<p>
Category, service area and availability confirmed.
</p>



</div>









<div class="verification-card">


<div class="verify-icon">

<i class="bi bi-shield-check"></i>

</div>



<span>
04
</span>



<h4>
VERIFIED PROVIDER BADGE
</h4>



<p>
Provider becomes eligible for emergency dispatch.
</p>



</div>







</div>









<div class="verification-note">


Only verified, active and available providers can receive emergency requests.


</div>







<a href="#" class="provider-button">

START PROVIDER REGISTRATION

</a>







</div>


</section>
<!-- ================= RECOMMENDATION ENGINE ================= -->

<section class="recommendation-engine">

    <div class="recommendation-container">


        <!-- LEFT SIDE -->

        <div class="recommendation-left">


            <span class="section-label">
                RECOMMENDATION ENGINE
            </span>


            <h2>
                Rule-Based Intelligent<br>
                Provider Recommendation
            </h2>


            <p>
                Every eligible provider is scored against a fixed, auditable weighting.
                No hidden ordering, no paid placement — the same formula runs for
                dispatch and for the public directory.
            </p>



            <div class="weight-box">


                <div class="weight-row">

                    <span>
                        DISTANCE
                    </span>

                    <div class="progress">
                        <div class="bar distance"></div>
                    </div>

                    <b>
                        40%
                    </b>

                </div>




                <div class="weight-row">

                    <span>
                        AVAILABILITY
                    </span>

                    <div class="progress">
                        <div class="bar availability"></div>
                    </div>

                    <b>
                        25%
                    </b>

                </div>




                <div class="weight-row">

                    <span>
                        RATING
                    </span>

                    <div class="progress">
                        <div class="bar rating"></div>
                    </div>

                    <b>
                        20%
                    </b>

                </div>




                <div class="weight-row">

                    <span>
                        EXPERIENCE
                    </span>

                    <div class="progress">
                        <div class="bar experience"></div>
                    </div>

                    <b>
                        15%
                    </b>

                </div>



            </div>


        </div>





        <!-- RIGHT SIDE -->

        <div class="ranking-area">


            <span class="section-label">
                SAMPLE RANKING · AMBULANCE REQUEST, DHANMONDI
            </span>



            <div class="provider-ranking active">


                <div class="score">
                    91
                    <small>SCORE</small>
                </div>


                <div class="provider-info">

                    <h4>
                        Rapid Care Ambulance
                    </h4>

                    <p>
                        AMBULANCE · DHAKA · 1.2 KM · 4.9 ★ · 7 YRS
                    </p>

                </div>


                <span class="available">
                    AVAILABLE
                </span>


                <span class="broadcast">
                    FIRST BROADCAST
                </span>


            </div>






            <div class="provider-ranking">


                <div class="score">
                    83
                    <small>SCORE</small>
                </div>


                <div class="provider-info">

                    <h4>
                        Dhaka Emergency Ambulance
                    </h4>

                    <p>
                        AMBULANCE · MOHAMMADPUR · 2.8 KM · 4.7 ★ · 6 YRS
                    </p>

                </div>


                <span class="available">
                    AVAILABLE
                </span>


            </div>







            <div class="provider-ranking">


                <div class="score">
                    78
                    <small>SCORE</small>
                </div>


                <div class="provider-info">

                    <h4>
                        City Rescue Ambulance
                    </h4>

                    <p>
                        AMBULANCE · KALABAGAN · 3.4 KM · 4.5 ★ · 4 YRS
                    </p>

                </div>


                <span class="available">
                    AVAILABLE
                </span>


            </div>



            <a href="#" class="directory-link">
                OPEN PROVIDER DIRECTORY
            </a>



        </div>


    </div>


</section>
<!-- ================= PRIORITY SYSTEM ================= -->

<section class="priority-system">

<div class="section-container">


<span class="section-label">
PRIORITY SYSTEM
</span>


<h2>
Four priority tiers,<br>
processed in strict order.
</h2>



<div class="priority-grid">


<div class="priority-card">

<span class="priority critical">
CRITICAL
</span>

<p>
Immediate emergency response and priority broadcast.
</p>

</div>




<div class="priority-card">

<span class="priority high">
HIGH
</span>

<p>
Urgent service requiring faster provider assignment.
</p>

</div>




<div class="priority-card">

<span class="priority medium">
MEDIUM
</span>

<p>
Important but non-life-threatening service.
</p>

</div>




<div class="priority-card">

<span class="priority normal">
NORMAL
</span>

<p>
Routine home assistance.
</p>

</div>



</div>


</div>

</section>





<!-- ================= SERVICE TRACKING ================= -->


<section class="service-tracking">


<div class="section-container">


<span class="section-label">
SERVICE TRACKING
</span>



<h2>
Every request moves through<br>
one visible status chain.
</h2>




<div class="status-chain">


<div class="status-item pending">

<span class="status-number">
01
</span>

<i></i>

<b>
PENDING
</b>

</div>



<div class="status-item">

<span class="status-number">
02
</span>

<i></i>

<b>
BROADCASTING
</b>

</div>



<div class="status-item">

<span class="status-number">
03
</span>

<i></i>

<b>
ACCEPTED
</b>

</div>



<div class="status-item">

<span class="status-number">
04
</span>

<i></i>

<b>
ON THE WAY
</b>

</div>



<div class="status-item">

<span class="status-number">
05
</span>

<i></i>

<b>
ARRIVED
</b>

</div>



<div class="status-item">

<span class="status-number">
06
</span>

<i></i>

<b>
WORKING
</b>

</div>



<div class="status-item">

<span class="status-number">
07
</span>

<i></i>

<b>
WAITING FOR CONFIRMATION
</b>

</div>




<div class="status-item completed">

<span class="status-number">
08
</span>

<i></i>

<b>
COMPLETED
</b>

</div>


</div>




<div class="verification-status-grid">


<div>
<i class="bi bi-key"></i>

<h4>
Arrival PIN verification
</h4>

<span>
REQUIRED AT ARRIVED
</span>

</div>




<div>

<i class="bi bi-camera"></i>

<h4>
Before photo evidence
</h4>

<span>
REQUIRED AT WORKING
</span>

</div>




<div>

<i class="bi bi-camera"></i>

<h4>
After photo evidence
</h4>

<span>
REQUIRED AT WAITING FOR CONFIRMATION
</span>

</div>




<div>

<i class="bi bi-check-circle"></i>

<h4>
Completion PIN confirmation
</h4>

<span>
REQUIRED AT COMPLETED
</span>

</div>



</div>



</div>


</section>

<!-- ================= SAFETY AND EVIDENCE ================= -->

<section class="safety-evidence-section">

    <div class="section-container">

        <div class="safety-evidence-wrapper">


            <!-- LEFT SIDE -->

            <div class="safety-left">

                <div class="section-label">
                    SAFETY AND EVIDENCE
                </div>


                <h2>
                    The customer holds the keys at both ends of the job.
                </h2>


                <p>
                    Dual confirmation means a service cannot be recorded as started or finished on the provider's word alone. Each blocking rule is enforced in the request state machine.
                </p>


            </div>



            <!-- RIGHT SIDE -->

            <div class="safety-right">


                <div class="safety-rule">

                    <i class="bi bi-shield-check"></i>

                    <span>
                        Provider cannot mark Arrived without the customer's Arrival PIN.
                    </span>

                </div>



                <div class="safety-rule">

                    <i class="bi bi-shield-check"></i>
                    <span>
                        Provider cannot start work without uploading a before photo.
                    </span>

                </div>



                <div class="safety-rule">

                    <i class="bi bi-shield-check"></i>
                    <span>
                        Provider cannot request completion without uploading an after photo.
                    </span>

                </div>



                <div class="safety-rule">

                    <i class="bi bi-shield-check"></i>

                    <span>
                        Provider cannot mark Completed without the customer's Completion PIN.
                    </span>

                </div>



                <div class="safety-rule">

                    <i class="bi bi-clipboard-check"></i>

                    <span>
                        Customer and admin can review the full evidence trail for any request.
                    </span>

                </div>



                <div class="safety-rule">

                    <i class="bi bi-camera"></i>

                    <span>
                        Private evidence — PINs and service photos — is never shown publicly.
                    </span>

                </div>


            </div>


        </div>

    </div>

</section>
<section class="cta-section">

    <div class="section-container">

        <div class="cta-wrapper">


            <!-- CUSTOMER CARD -->

            <div class="cta-card">

                <div class="cta-label">
                    CUSTOMER
                </div>

                <h2>
                    NEED EMERGENCY ASSISTANCE?
                </h2>

                <p>
                    Create a request in under a minute. Priority, address
                    and problem details go straight to the nearest eligible
                    verified provider.
                </p>


                <a href="#" class="cta-btn red-btn">
                    REQUEST HELP NOW
                </a>

            </div>



            <!-- PROVIDER CARD -->

            <div class="cta-card">

                <div class="cta-label">
                    PROVIDER
                </div>

                <h2>
                    READY TO JOIN THE VERIFIED PROVIDER NETWORK?
                </h2>

                <p>
                    Complete phone OTP verification and admin review to
                    start receiving priority-ranked requests in your service
                    area.
                </p>


                <a href="#" class="cta-btn black-btn">
                    BECOME A PROVIDER
                </a>

            </div>


        </div>

    </div>

</section>
<section class="faq-section">

    <div class="section-container">


        <div class="faq-header">

            <div class="section-label">
                FREQUENTLY ASKED
            </div>


            <h2>
                Questions about verification,<br>
                dispatch and PINs.
            </h2>

        </div>



        <div class="faq-list">


            <div class="faq-item">
                <span>HOW ARE PROVIDERS VERIFIED?</span>
                <i class="bi bi-chevron-down"></i>
            </div>


            <div class="faq-item">
                <span>HOW DOES PROVIDER RECOMMENDATION WORK?</span>
                <i class="bi bi-chevron-down"></i>
            </div>


            <div class="faq-item">
                <span>WHAT HAPPENS IF A PROVIDER REJECTS THE REQUEST?</span>
                <i class="bi bi-chevron-down"></i>
            </div>


            <div class="faq-item">
                <span>WHAT IS AN ARRIVAL PIN?</span>
                <i class="bi bi-chevron-down"></i>
            </div>


            <div class="faq-item">
                <span>WHAT IS A COMPLETION PIN?</span>
                <i class="bi bi-chevron-down"></i>
            </div>


            <div class="faq-item">
                <span>CAN A PROVIDER COMPLETE A SERVICE WITHOUT CUSTOMER APPROVAL?</span>
                <i class="bi bi-chevron-down"></i>
            </div>


        </div>


    </div>

</section>
@endsection