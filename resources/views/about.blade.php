@extends('layouts.app')


@section('content')


<!-- HERO -->

<section class="about-hero">

<div class="services-container">

<div class="section-label">
SECTION 01 — 03 · PROBLEM, OBJECTIVES, LOGIC
</div>


<h1>
Not a booking app. An 
<span>emergency management platform.</span>
</h1>


<p>
Smart Emergency Helper coordinates verified emergency, technical and home
service providers using priority-based dispatch, automated escalation and a
transparent audit trail for every job.
</p>


</div>

</section>





<!-- PROBLEM OBJECTIVE -->


<section class="about-problem">

<div class="services-container">


<div class="about-columns">



<div>


<div class="about-title red-dot">
PROBLEM STATEMENT
</div>


<ul class="about-list">

<li>Trusted providers are hard to find in a real emergency.</li>

<li>Response time depends on phone calls and social media posts.</li>

<li>No visibility into which provider is actually available.</li>

<li>No tracking once a job is accepted.</li>

<li>Risk of unverified or fake providers.</li>

<li>Weak complaint and review handling.</li>

</ul>


</div>





<div>


<div class="about-title blue-dot">
OBJECTIVES
</div>


<ul class="about-list">

<li>Cut emergency response time with automated matching.</li>

<li>Guarantee safety through admin-verified providers.</li>

<li>Recommend the single best provider, not a long list.</li>

<li>Make request creation and tracking a two-minute flow.</li>

<li>Give Customer, Provider and Admin purpose-built dashboards.</li>


</ul>


</div>



</div>


</div>

</section>







<!-- SCORE -->


<section class="score-section">


<div class="services-container">


<h2>
RECOMMENDATION SCORE
</h2>


<p>
The core selling point: every candidate provider is scored, and the highest
score is dispatched first.
</p>



<div class="score-grid">


<div class="score-card">
<h3>40%</h3>
<b>DISTANCE</b>
<p>Nearest provider wins the biggest weight.</p>
</div>


<div class="score-card">
<h3>25%</h3>
<b>AVAILABILITY</b>
<p>Available beats Busy; Offline is excluded.</p>
</div>


<div class="score-card">
<h3>20%</h3>
<b>RATING</b>
<p>Historic customer feedback average.</p>
</div>


<div class="score-card">
<h3>15%</h3>
<b>EXPERIENCE</b>
<p>Completed job count in that category.</p>
</div>


</div>


</div>


</section>







<!-- WORKFLOW -->


<section class="workflow-section">


<div class="services-container">


<h2>
DISPATCH WORKFLOW
</h2>


<div class="workflow">


@php

$steps=[
'REQUEST CREATED',
'ELIGIBLE PROVIDERS FILTERED',
'PROVIDERS RANKED',
'DISPATCH OFFER',
'PROVIDER ACCEPTED',
'ON THE WAY',
'ARRIVAL PIN',
'ARRIVED',
'BEFORE PHOTO',
'WORKING',
'AFTER PHOTO',
'COMPLETION PIN',
'COMPLETED',
'RATING / REVIEW',
'OPTIONAL COMPLAINT'
];

@endphp


@foreach($steps as $key=>$step)

<div class="workflow-box">

<small>
{{sprintf("%02d",$key+1)}}
</small>

{{ $step }}

</div>

@if(!$loop->last)
<span>→</span>
@endif


@endforeach


</div>


</div>


</section>








<!-- BUSINESS RULE -->


<section class="rules-section">


<div class="services-container">


<h2>
BUSINESS RULES
</h2>



<div class="rules-grid">


@php

$rules=[
'Only Verified AND Available providers receive requests.',
'Requests are first filtered by matching service category.',
'A rejection broadcasts the request to the next provider.',
'Reviews unlock only after a service is Completed.',
'Busy providers never receive new requests.',
'Critical priority is always processed first.',
'Complaints are allowed only on Completed services.'
];

@endphp



@foreach($rules as $key=>$rule)


<div class="rule-card">

<small>
RULE {{ $key+1 }}
</small>


<p>
{{ $rule }}
</p>


</div>


@endforeach


</div>



<a href="#" class="btn-primary">
REQUEST EMERGENCY ASSISTANCE
</a>


<a href="#" class="btn-secondary">
BROWSE VERIFIED PROVIDERS
</a>



</div>


</section>




@endsection