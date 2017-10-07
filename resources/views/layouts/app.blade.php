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



</head>
<body>
<main id="app">

    <nav class="orange">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">KickoffWP</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                @auth
                    <li><a href="{{ url('/home') }}">Home</a></li>
                @else
                    {{--<li><a href="{{ route('login') }}">Login</a></li>--}}
                    {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                @endauth
            </ul>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</main>

<footer class="page-footer orange">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h5 class="white-text">KickoffWP</h5>
                <p>&copy; 2017 Chris Perko</p>
            </div>
        </div>
    </div>
</footer>
</body>

<!-- JS -->
<script src="{{asset('js/app.js')}}"></script>

@if(env('APP_ENV') != 'local')
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-26651291-14"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-26651291-14');
</script>
@endif

</html>
