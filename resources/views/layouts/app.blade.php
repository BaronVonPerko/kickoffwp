<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KickoffWP</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/vendor.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<main id="app">

    @include('parts.navbar')

    <div class="container-fluid">
        @yield('content')
    </div>

    <toast message="{{ session('flash') }}"></toast>
</main>

<footer class="footer">
    <div class="container">
        <div class="content has-text-centered">
            <strong>KickoffWP</strong>
            <p>&copy; {{ date('Y') }} <a href="http://ChrisPerko.net" target="_blank" class="white-text">Chris Perko</a>
            </p>
        </div>
    </div>
    </div>
</footer>
</body>

<!-- JS -->
<script src="{{asset('js/app.js')}}"></script>

@if(env('APP_ENV') != 'local')
    @include('layouts.ga')
@endif

@include('layouts.navbar')

</html>
