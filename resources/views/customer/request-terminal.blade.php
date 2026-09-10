@extends('layouts.app')

@section('content')

<h1>
Emergency Request Terminal
</h1>

<p>
Request ID:
{{ $emergency->reference }}
</p>

<p>
Status:
{{ $emergency->status }}
</p>

@endsection