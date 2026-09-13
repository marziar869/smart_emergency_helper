<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>
        Smart Emergency Helper
    </title>


    <!-- Bootstrap Icons -->
    <link 
        rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <!-- Main CSS -->
    <link 
        rel="stylesheet" 
        href="{{ asset('css/style.css') }}"
    >

</head>

<body>


    <!-- Navigation -->
    @include('partials.navbar')

    <!-- Page Content -->
    <main>@yield('content')</main>


    <!-- Footer -->
    @include('partials.footer')
<script src="{{ asset('js/main.js') }}"></script>

</body>

</html>