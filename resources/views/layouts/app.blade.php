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

    <nav class="navbar is-primary">
        <div class="container">
            <div class="navbar-brand">
                <a href="/" class="navbar-item is-size-4">KickoffWP</a>

                <button class="button navbar-burger">
                    <span></span><span></span><span></span>
                </button>
            </div>

            @if(env('APP_ENV') == 'local')
                <div class="navbar-menu navbar-end">
                    <a class="navbar-item" target="_blank"
                       href="https://github.com/BaronVonPerko/kickoffwp">
                        Contribute
                    </a>

                    <a class="navbar-item" target="_blank"
                       href="https://github.com/BaronVonPerko/kickoffwp/issues">
                        Report Issues
                    </a>

                    <a href="/start" class="navbar-item">Start</a>

                    @guest()
                        <a href="/login" class="navbar-item">Login</a>
                        <a href="/register" class="navbar-item">Register</a>
                    @endguest

                    @auth()
                        <a href="/logout" class="navbar-item">Logout</a>
                    @endauth
                </div>
            @endif
        </div>
    </nav>

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
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-26651291-14"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-26651291-14');
    </script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Get all "navbar-burger" elements
        var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

            // Add a click event on each of them
            $navbarBurgers.forEach(function ($el) {
                $el.addEventListener('click', function () {

                    // Get the target from the "data-target" attribute
                    var target = $el.dataset.target;
                    var $target = document.getElementById(target);

                    // Toggle the class on both the "navbar-burger" and the "navbar-menu"
                    $el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');

                });
            });
        }

    });
</script>


</html>
