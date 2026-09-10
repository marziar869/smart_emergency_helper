@extends('layouts.app')

@section('title', 'Provider Dashboard — Smart Emergency Helper')

@section('content')

<section class="provider-dashboard-page">

<div class="provider-dashboard-container">


{{-- ===========================
 HEADER
=========================== --}}

<div class="provider-dashboard-header">


<div class="provider-top-section">


<div class="provider-feed-title">

<h1>
PROVIDER FEED
</h1>


<span class="provider-current-status">

<span class="status-dot"></span>

Available

</span>

</div>



<div class="provider-links">

<a href="{{ route('provider.profile') }}">
Provider Profile & Trust
</a>


<a href="{{ route('provider.verification') }}">
Verification
</a>


</div>


</div>



<p class="provider-description">

Only Available + Verified + Active providers receive new requests.<br>

Busy, Offline, Suspended and Unverified providers do not.

</p>



<div class="provider-status-wrapper">


<button class="provider-status-btn active">

AVAILABLE

</button>



<button class="provider-status-btn">

BUSY

</button>



<button class="provider-status-btn">

OFFLINE

</button>


</div>


</div>





{{-- ===========================
 MAIN AREA
=========================== --}}


<div class="row g-4">



{{-- ===========================
 PENDING ALERTS
=========================== --}}



<div class="col-lg-3">


<div class="provider-alert-column">


<h2 class="provider-alert-heading">

PENDING ALERTS

</h2>




@foreach($requests as $request)


<div class="provider-alert-card">


<div class="provider-alert-top">


<strong>

#{{ $request->reference }}

</strong>



<span class="alert-badge">

{{ strtoupper($request->priority) }}

</span>


</div>




<h3>

{{ $request->description }}

</h3>



<p class="provider-alert-location">

{{ $request->area }}

</p>




<div class="provider-alert-actions">


<form method="POST" action="{{route('provider.accept',$request->id)}}">

@csrf

<button type="submit">
ACCEPT
</button>

</form>




<form method="POST"
action="{{ route('provider.request.reject',$request->id) }}">

@csrf

<button type="submit"
class="provider-decline-btn">

DECLINE

</button>

</form>



</div>



</div>


@endforeach




<p class="provider-alert-note">

Declined or expired requests automatically move to the next eligible provider.

</p>



</div>


</div>





{{-- ===========================
 ACTIVE JOB
=========================== --}}



<div class="col-lg-9">


<div class="provider-active-job-card">



<div class="provider-active-job-header">


<div>


@if($activeJob)


<h2>

ACTIVE JOB: {{ $activeJob->reference }}

</h2>



<p>

Customer:
{{ $activeJob->customer->name ?? 'N/A' }}

</p>


<p>

Area:
{{ $activeJob->area }}

</p>



<p>

Issue:
{{ $activeJob->description }}

</p>



@else


<h2>

NO ACTIVE JOB

</h2>


@endif



</div>
{{-- ===========================
 JOB BADGES
=========================== --}}


<div class="provider-job-badges">


<span class="provider-job-service">

@if($activeJob)

{{ $activeJob->serviceCategory->name ?? 'SERVICE' }}

@else

NO SERVICE

@endif

</span>



<span class="provider-job-phase">

PHASE:

@if($activeJob)

{{ strtoupper($activeJob->status) }}

@else

-

@endif

</span>



<span class="provider-job-priority">

@if($activeJob)

{{ strtoupper($activeJob->priority) }}

@endif

</span>


</div>



</div>




{{-- ===========================
 ACTIVE JOB FLOW
=========================== --}}


<div class="provider-job-flow">


<button class="active">
ACCEPTED
</button>


<button>
ON THE WAY
</button>


<button>
ARRIVAL PIN REQUIRED
</button>


<button>
ARRIVED
</button>


<button>
BEFORE PHOTO REQUIRED
</button>


<button>
WORKING
</button>


<button>
AFTER PHOTO REQUIRED
</button>


<button>
COMPLETION PIN REQUIRED
</button>


<button>
COMPLETED
</button>


</div>




{{-- ===========================
 SITE + INCIDENT
=========================== --}}


<div class="provider-middle-grid">



<div class="site-assessment">


<h3>
Site Assessment
</h3>



<div class="photo-grid">



<div class="before-photo-box">


<img src="{{ asset('images/before-photo.jpg') }}"
alt="Before Service">


<p>
Before Service
</p>


</div>




<div class="upload-after">


<label for="afterPhoto">

UPLOAD AFTER

</label>


<input
type="file"
id="afterPhoto"
hidden
>


<p>
Pending After
</p>


</div>



</div>


</div>





<div class="incident-protocol">


<h3>
Incident Protocol
</h3>



<ul>


<li class="complete">

Establish perimeter

</li>



<li class="complete">

Identify primary trauma

</li>



<li>

Stabilize for transport

</li>



<li>

Signal hospital ready

</li>


</ul>



</div>



</div>






{{-- ===========================
 NEXT ACTION
=========================== --}}



<div class="next-action">


<h4>

NEXT REQUIRED ACTION

</h4>



<button id="startDriving">


START DRIVING — MARK ON THE WAY


</button>



</div>



</div>


</div>


</div>


</section>





<script>


document.addEventListener(
"DOMContentLoaded",
function(){



document
.querySelectorAll('.provider-status-btn')
.forEach(btn=>{


btn.onclick=function(){


document
.querySelectorAll('.provider-status-btn')
.forEach(b=>b.classList.remove('active'));


this.classList.add('active');


}


});





document
.querySelectorAll('.provider-decline-btn')
.forEach(btn=>{


btn.onclick=function(){


let card=this.closest(
'.provider-alert-card'
);


card.remove();


alert(
"Request Declined"
);


}


});





let startButton =
document.getElementById('startDriving');


if(startButton){


startButton.onclick=function(){


alert(
"Job status updated: ON THE WAY"
);


};


}



});


</script>


@endsection