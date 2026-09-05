@extends('layouts.app')


@section('content')


<section class="protected-page">


    <div class="protected-card">


        <div class="section-label">
            SIGN IN REQUIRED
        </div>


        <h1>
            EMERGENCY DISPATCH IS PROTECTED
        </h1>


        <p>
            Sign in as a customer to open the emergency request console.
            You will return to this page immediately after signing in.
        </p>



        <div class="protected-actions">


            <a href="{{ route('login', ['intended'=>'/request-emergency']) }}" 
               class="btn-primary">

                SIGN IN TO CONTINUE

            </a>



            <a href="{{ route('home') }}" 
               class="btn-secondary">

                BACK TO HOME

            </a>


        </div>


    </div>


</section>


@endsection