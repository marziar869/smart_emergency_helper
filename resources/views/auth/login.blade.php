@extends('layouts.app')

@section('content')


<section class="login-section">


<div class="login-card">


<div class="section-label">
ACCOUNT ACCESS
</div>


<h1>
SIGN IN
</h1>




<div class="demo-box">

<strong>
SECURE ACCOUNT SIGN IN
</strong>

<p>
Sign in using your registered email, password and account type.
</p>

</div>





<form method="POST" action="{{ route('demo.login') }}">

@csrf



<input type="hidden" name="intended" value="{{ request('intended') }}">



<label>
EMAIL
</label>


<input 
type="email" 
name="email"
placeholder="you@example.com"
required
>




<label>
PASSWORD
</label>


<input 
type="password"
name="password"
placeholder="••••••••"
required
>




<label>
ROLE
</label>



<div class="role-buttons">


<label class="role active">

<input type="radio" name="role" value="customer" checked>

CUSTOMER

</label>




<label class="role">

<input type="radio" name="role" value="provider">

PROVIDER

</label>




<label class="role">

<input type="radio" name="role" value="admin">

ADMIN

</label>



</div>





<button class="login-btn">
SIGN IN
</button>





<div class="register-links">

    <span>
        No account?
    </span>


    <a href="{{ route('customer.register') }}">
        <strong>REGISTER AS CUSTOMER</strong>
    </a>


    <span class="separator">
        ·
    </span>


    <a href="{{ route('provider.register') }}">
        <strong>AS PROVIDER</strong>
    </a>

</div>



</form>


</div>


<script>

document.addEventListener("DOMContentLoaded", function(){


    const roles = document.querySelectorAll(".role");


    roles.forEach(function(role){


        role.addEventListener("click", function(){


            roles.forEach(function(item){

                item.classList.remove("active");

            });



            this.classList.add("active");



            const radio = this.querySelector("input");

            radio.checked = true;


        });


    });


});

</script>


</section>



@endsection