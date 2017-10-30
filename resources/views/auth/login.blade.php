@extends('layouts.app')

@section('content')

    <form action="{{route('login')}}" method="post" class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">

                <div class="column is-6 is-offset-3">
                    <h3 class="title has-text-grey">Login</h3>

                    <div class="box has-text-left">

                        {{ csrf_field() }}

                        <div class="field">
                            <div class="label">Email</div>
                            <div class="control has-icons-left">
                                <input type="email" placeholder="Email address" id="email" name="email" class="input"
                                       value="{{ old('email') }}" required autofocus>
                                <span class="icon is-small is-left">
                                    <i class="material-icons">email</i>
                                </span>
                            </div>
                        </div>

                        @if ($errors->has('email'))
                            <p class="help is-danger">{{ $errors->first('email') }}</p>
                        @endif

                        <div class="field">
                            <div class="label">Password</div>
                            <div class="control has-icons-left">
                                <input class="input" type="password" placeholder="Password" id="password" name="password" required>
                                <span class="icon is-small-is-left">
                                    <i class="material-icons">lock</i>
                                </span>
                            </div>
                        </div>

                        @if ($errors->has('password'))
                            <p class="help is-danger">{{ $errors->first('password') }}</p>
                        @endif

                        <div class="field">
                            <div class="control">
                                <label class="checkbox">
                                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <p class="field">
                            <button type="submit" class="button is-block is-info is-large is-fullwidth">
                                Login <i class="material-icons right">send</i>
                            </button>
                        </p>

                        <p class="field">
                            <a href="/register" class="button is-block is-grey">Register</a>
                        </p>

                    </div> <!-- end .box -->

                    <p class="has-text-grey">
                        <a href="/password/reset">Forgot Password</a>
                    </p>

                </div>
            </div>
        </div>
    </form>
@endsection
