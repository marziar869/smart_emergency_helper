@extends('layouts.app')

@section('content')

<div class="provider-profile-page">

<div class="provider-profile-container">


<!-- HEADER -->

<div class="provider-profile-header">

<div>

<p class="section-label">
PROVIDER ACCOUNT
</p>


<h1>
RAPID CARE AMBULANCE
</h1>


<span class="provider-id">
PRV-1041
</span>

</div>



<div class="provider-trust-badges">

<span class="badge approved">
APPROVED
</span>

<span class="badge verified">
VERIFIED
</span>

<span class="badge available">
AVAILABLE
</span>

<span class="badge trusted">
HIGHLY TRUSTED
</span>


</div>


</div>





<!-- PROFILE INFORMATION -->

<div class="profile-card">


<h3>
PROFILE INFORMATION
</h3>


<div class="profile-grid">


<div>

<label>
PROVIDER NAME
</label>

<h4>
Rapid Care Ambulance
</h4>


<label>
PHONE
</label>

<h4>
+880 1711-004101
</h4>


<label>
PRIMARY SERVICE
</label>

<h4>
Ambulance
</h4>


<label>
SERVICE AREA
</label>

<h4>
Dhanmondi, Mohammadpur, Kalabagan · Dhaka
</h4>


</div>




<div>

<label>
PROVIDER ID
</label>

<h4>
PRV-1041
</h4>



<label>
EMAIL
</label>

<h4>
rapidcare@seh.com.bd
</h4>



<label>
EXPERIENCE
</label>

<h4>
7 Years
</h4>



</div>




<div class="profile-image">


<label>
PROFILE PHOTO
</label>


<img src="{{ asset('images/ambulanceprovider1.jpg') }}">


</div>


</div>



<div class="profile-actions">

<button>
EDIT PROFILE
</button>

<button>
UPDATE SERVICE AREA
</button>


</div>


</div>





<!-- VERIFICATION SUMMARY -->


<div class="profile-card">


<h3>
VERIFICATION SUMMARY
</h3>


<p class="verified-text">
✓ Phone OTP Verified
</p>


<p class="verified-text">
✓ Admin Approved
</p>



<p>
Verification consists of phone ownership (OTP) plus administrator approval. No national ID or biometric check is used.
</p>


</div>






<!-- PERFORMANCE -->


<div class="profile-card">


<h3>
PERFORMANCE
</h3>


<div class="performance-grid">


<div>
<label>
AVERAGE RATING
</label>
<strong>
4.9 / 5
</strong>
</div>


<div>
<label>
COMPLETED JOBS
</label>
<strong>
412
</strong>
</div>


<div>
<label>
ACCEPTANCE RATE
</label>
<strong>
94%
</strong>
</div>


<div>
<label>
CANCELLATION RATE
</label>
<strong>
2%
</strong>
</div>


<div>
<label>
VALID COMPLAINTS
</label>
<strong>
2
</strong>
</div>


</div>


</div>






<!-- TRUST -->


<div class="profile-card">


<h3>
RULE-BASED PROVIDER TRUST & RISK MONITORING
</h3>



<div class="trust-score">

88

<span>
/100
</span>

</div>


<span class="trust-badge">
HIGHLY TRUSTED
</span>



<h5>
POSITIVE TRUST FACTORS
</h5>


<div class="trust-grid">

<div>
<span class="green-square"></span>
Phone OTP Verification
</div>

<div>
<span class="green-square"></span>
Admin Approval
</div>


<div>
<span class="green-square"></span>
Completed Job History
</div>


<div>
<span class="green-square"></span>
Average Rating
</div>


<div>
<span class="green-square"></span>
Complaint Rate
</div>


<div>
<span class="green-square"></span>
Cancellation Rate
</div>


</div>





<h5 class="scale-title">
TRUST LEVEL SCALE
</h5>


<table class="trust-scale-table">


<tr>
<th>
SCORE RANGE
</th>

<th>
LEVEL
</th>
</tr>


<tr class="active-scale">

<td>
80 - 100
</td>

<td>
HIGHLY TRUSTED
</td>

</tr>



<tr>

<td>
60 - 79
</td>

<td>
TRUSTED
</td>

</tr>



<tr>

<td>
40 - 59
</td>

<td>
UNDER OBSERVATION
</td>

</tr>



<tr>

<td>
20 - 39
</td>

<td>
HIGH RISK
</td>

</tr>



<tr>

<td>
Below 20
</td>

<td>
RESTRICTED
</td>

</tr>


</table>
<h5 class="risk-title">
EXAMPLE RISK EVENTS
</h5>


<div class="risk-grid">


<div>
<span class="orange-square"></span>
Repeated Cancellations
</div>


<div>
<span class="orange-square"></span>
Valid Complaints
</div>


<div>
<span class="orange-square"></span>
Repeated Incorrect Completion PIN Attempts
</div>


<div>
<span class="orange-square"></span>
Missing Photo Evidence
</div>


<div>
<span class="orange-square"></span>
Admin Warnings
</div>


</div>


<p class="risk-note">
High-risk providers are flagged for manual admin review. Providers are never auto-banned by score alone.
</p>


</div>






<!-- REVIEWS -->


<div class="profile-card">


<h3>
CUSTOMER REVIEWS
</h3>



<div class="review-grid">


<div class="review">
<h4>
Md. Arif Hossain
</h4>

<span>
★★★★★
</span>

<p>
Reached within 10 minutes for a cardiac emergency. Very professional crew.
</p>

</div>



<div class="review">

<h4>
Farzana Akter
</h4>

<span>
★★★★★
</span>

<p>
Calm and quick response. Driver knew the fastest route to the hospital.
</p>


</div>



<div class="review">

<h4>
Tanvir Ahmed
</h4>

<span>
★★★★☆
</span>


<p>
Good service overall, slight delay in confirming the address.
</p>


</div>




<div class="review">

<h4>
Sadia Rahman
</h4>


<span>
★★★★★
</span>


<p>
Excellent, well-equipped ambulance. Highly recommended.
</p>


</div>


</div>


</div>



<a href="{{ route('provider.dashboard') }}" class="back-btn">
BACK TO PROVIDER FEED
</a>



</div>

</div>


@endsection