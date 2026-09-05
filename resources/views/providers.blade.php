@extends('layouts.app')


@section('content')


<section class="providers-hero">

<div class="services-container">

<div class="section-label">
DIRECTORY · RANKED BY RECOMMENDATION SCORE
</div>


<h1>
Provider directory
</h1>


<p>
The same scoring engine that powers automatic dispatch, exposed as a browsable list.
</p>


</div>

</section>




<section class="providers-list">

<div class="services-container">



<div class="provider-filter">

<button class="active">
ALL
</button>

<button>
EMERGENCY
</button>

<button>
TECHNICAL
</button>

<button>
HOME
</button>


<label>
<input type="checkbox" checked>
VERIFIED ONLY
</label>


<label>
<input type="checkbox">
AVAILABLE ONLY
</label>


<span>
11 MATCHES
</span>


</div>





<!-- PROVIDER 1 -->

<div class="provider-card recommended">


<div class="provider-score">

<h1>
91
</h1>

<span>
SCORE
</span>

</div>



<div class="provider-details">


<div class="provider-title">

<h2>
Rapid Care Ambulance
</h2>


<span class="verified-badge">
VERIFIED PROVIDER
</span>


<span class="recommended-badge">
RECOMMENDED
</span>


</div>



<p>
Ambulance · Dhanmondi · 1.2 km away
</p>



<div class="provider-info">

<span>★ 4.9</span>
<span>412 JOBS</span>
<span>7 YRS EXP</span>
<span>HIGHLY TRUSTED</span>
<span>PRV-1041</span>

</div>



</div>




<div class="provider-buttons">


<button class="available">
AVAILABLE
</button>


<button class="view-btn">
VIEW PROVIDER
</button>


<button class="request-btn">
REQUEST SERVICE
</button>


</div>



</div>


<div class="provider-card">



<div class="provider-score">

<h1>
{{$provider[2]}}
</h1>

<span>
SCORE
</span>

</div>




<div class="provider-details">


<div class="provider-title">


<h2>
{{$provider[0]}}
</h2>


<span class="verified-badge">
VERIFIED PROVIDER
</span>


</div>



<p>
{{$provider[1]}}
</p>




<div class="provider-info">

<span>★ 4.6</span>
<span>288 JOBS</span>
<span>5 YRS EXP</span>
<span>HIGHLY TRUSTED</span>
<span>PRV-1044</span>

</div>



</div>





<div class="provider-buttons">


<button class="available">
AVAILABLE
</button>


<button class="view-btn">
VIEW PROVIDER
</button>


<button class="request-btn">
REQUEST SERVICE
</button>


</div>



</div>

</div>

</section>


@endsection