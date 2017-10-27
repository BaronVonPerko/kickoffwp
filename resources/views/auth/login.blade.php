@extends('layouts.app')

@section('content')

    <form action="{{route('login')}}" method="post" class="container">
        <div class="row">
            <div class="col s12">

                <div class="card teal lighten-5">
                    <div class="card-content">
                        <span class="card-title">Login</span>

                            {{ csrf_field() }}
                            <div class="input-field">
                                <input type="email" placeholder="Email address" id="email" name="email" class="validate"
                                       value="{{ old('email') }}" required autofocus>
                                <label for="email">Email Address</label>
                            </div>

                            @if ($errors->has('email'))
                                <span class="red-text">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                            @endif

                            <div class="input-field">
                                <input type="password" placeholder="Password" id="password" name="password" required>
                                <label for="password">Password</label>
                            </div>

                            @if ($errors->has('password'))
                                <span class="red-text">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                            @endif

                            <p>
                                <input type="checkbox" id="remember"
                                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">Remember Me</label>
                            </p>

                            <div>
                                <button type="submit" class="btn waves">
                                    Login
                                    <i class="material-icons right">send</i>
                                </button>

                                <a class="btn-flat waves" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
