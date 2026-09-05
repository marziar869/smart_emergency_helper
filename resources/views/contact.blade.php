@extends('layouts.app')


@section('content')


<!-- HERO -->

<section class="contact-hero">

<div class="services-container">


<div class="section-label">
CONTROL ROOM · ONLINE 24/7
</div>


<h1>
Talk to dispatch
</h1>


<p>
For a life-threatening emergency, always call the official national emergency
number 999 first. The form below is for enquiries, onboarding and follow-up.
</p>



<div class="contact-notice">

Smart Emergency Helper coordinates emergency and home-assistance service
providers and does not replace official national emergency services.

</div>



</div>

</section>






<!-- CONTACT INFO -->


<section class="contact-info">


<div class="services-container">


<div class="contact-cards">



<div class="contact-card">

<small>
OFFICIAL EMERGENCY NUMBERS
</small>


<h3>
999 · 16263
</h3>


<p>
Government-operated national emergency lines — not operated by Smart Emergency Helper.
</p>


</div>





<div class="contact-card">

<small>
COORDINATION DESK
</small>


<h3>
+880 1700-000000
</h3>


<p>
Ambulance, blood donor, home nurse, electrician, plumber, AC technician and locksmith coordination.
</p>


</div>





<div class="contact-card">

<small>
CONTROL ROOM EMAIL
</small>


<h3>
dispatch@smartemergencyhelper.bd
</h3>


<p>
Stalled requests, provider verification, complaint follow-up.
</p>


</div>



</div>


</div>


</section>








<!-- FORM AREA -->


<section class="contact-main">


<div class="services-container">



<div class="contact-grid">



<!-- FORM -->


<div class="contact-form-box">


<h2>
SEND AN ENQUIRY
</h2>



<div class="form-row">


<div>
<label>FULL NAME</label>
<input placeholder="Your name">
</div>



<div>
<label>EMAIL</label>
<input placeholder="you@example.com">
</div>


</div>



<label>
TOPIC
</label>


<div class="topic-grid">


<button class="active">
GENERAL ENQUIRY
</button>


<button>
ESCALATE A REQUEST
</button>


<button>
PROVIDER ONBOARDING
</button>


<button>
COMPLAINT FOLLOW-UP
</button>


</div>




<label>
MESSAGE
</label>


<textarea placeholder="Describe your enquiry..."></textarea>



<button class="submit-btn">
SUBMIT ENQUIRY
</button>



</div>








<!-- SIDE -->


<div class="contact-side">



<div class="side-box">


<h3>
COVERAGE ZONES
</h3>


<ul>

<li>Dhanmondi <span>LIVE</span></li>
<li>Gulshan · Banani <span>LIVE</span></li>
<li>Uttara <span>LIVE</span></li>
<li>Mirpur · Shyamoli <span>LIVE</span></li>
<li>Bashundhara · Badda <span>LIVE</span></li>


</ul>


</div>





<div class="side-box">


<h3>
RESPONSE TARGETS
</h3>


<p class="small-text">
Internal service targets, not guaranteed response times.
</p>



<ul>

<li>
Critical dispatch
<strong>Highest priority</strong>
</li>


<li>
High priority
<strong>Prioritised queue</strong>
</li>


<li>
Enquiry reply
<strong>Same working day</strong>
</li>


<li>
Complaint review
<strong>Within review cycle</strong>
</li>


</ul>


</div>



</div>



</div>


</div>


</section>




@endsection