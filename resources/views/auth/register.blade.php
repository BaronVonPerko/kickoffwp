@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="hero is-fullheight">

        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-6 is-offset-3">
                    <div class="title has-text-grey">Register</div>

                    <div class="box has-text-left">

                        {{ csrf_field() }}

                        <div class="field">
                            <div class="label">Name</div>
                            <div class="control has-icons-left">
                                <input id="name" class="input" name="name" value="{{ old('name') }}"
                                       required autofocus placeholder="Name">
                                <span class="icon is-small is-left">
                                    <i class="material-icons">person_pin</i>
                                </span>
                            </div>
                        </div>

                        @if ($errors->has('name'))
                            <p class="help is-danger">{{ $errors->first('name') }}</p>
                        @endif

                        <div class="field">
                            <div class="label">Email Address</div>
                            <div class="control has-icons-left">
                                <input id="email" type="email" class="input" name="email"
                                       value="{{ old('email') }}" required placeholder="Email Address">
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
                                <input id="password" type="password" class="input" name="password" required placeholder="Password">
                                <span class="icon is-small is-left">
                                    <i class="material-icons">lock</i>
                                </span>
                            </div>
                        </div>

                        @if ($errors->has('password'))
                            <p class="help is-danger">{{ $errors->first('password') }}</p>
                        @endif


                        <div class="field">
                            <div class="label">Confirm Password</div>
                            <div class="control has-icons-left">
                                <input id="password_confirmation" type="password" class="input" name="password_confirmation" required placeholder="Confirm Password">
                                <span class="icon is-small is-left">
                                    <i class="material-icons">lock</i>
                                </span>
                            </div>
                        </div>

                        <p class="field">
                            <button class="button is-block is-info is-large is-fullwidth">
                                Register <i class="material-icons right">done</i>
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
