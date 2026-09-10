@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Emergency Request Terminal</h1>

    <div class="request-card">

        <h3>
            Request ID:
            {{ $emergency->reference }}
        </h3>


        <p>
            <strong>Status:</strong>

            {{ ucfirst($emergency->status) }}
        </p>


        <p>
            <strong>Priority:</strong>

            {{ $emergency->priority }}
        </p>


        <p>
            <strong>Area:</strong>

            {{ $emergency->area }}
        </p>


        <p>
            <strong>Address:</strong>

            {{ $emergency->address }}
        </p>


        <p>
            <strong>Description:</strong>

            {{ $emergency->description }}
        </p>


        <hr>


        <h3>
            Waiting for Provider Assignment
        </h3>


        <p>
            Your emergency request has been submitted successfully.
            A verified provider will be assigned soon.
        </p>


    </div>

</div>


@endsection