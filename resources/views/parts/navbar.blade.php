<nav class="navbar is-primary">
    <div class="container">
        <div class="navbar-brand">
            @guest()
                <a href="/" class="navbar-item is-size-4">KickoffWP</a>
            @endguest

            @auth()
                <a href="/start" class="navbar-item is-size-4">KickoffWP</a>
            @endauth

            <button class="button navbar-burger">
                <span></span><span></span><span></span>
            </button>
        </div>

        @if(env('APP_ENV') == 'local')
            <div class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" target="_blank"
                       href="https://github.com/BaronVonPerko/kickoffwp">
                        Contribute
                    </a>

                    <a class="navbar-item" target="_blank"
                       href="https://github.com/BaronVonPerko/kickoffwp/issues">
                        Report Issues
                    </a>
                </div>
                <div class="navbar-end">

                    @auth()
                        <a href="/start" class="navbar-item">Themes</a>
                    @endauth
                    @guest()
                        <a href="/start" class="navbar-item">Start</a>
                    @endguest

                    @guest()
                        <a href="/login" class="navbar-item">Login</a>
                        <a href="/register" class="navbar-item">Register</a>
                    @endguest

                    @auth()
                        <a href="/logout" class="navbar-item">Logout</a>
                    @endauth
                </div>
            </div>
        @endif
    </div>
</nav>