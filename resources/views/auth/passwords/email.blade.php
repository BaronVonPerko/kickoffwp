@extends('layouts.app')

@section('content')

    <form class="hero is-fullheight" method="POST" action="{{ route('password.email') }}">

        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-6 is-offset-3">
                    <div class="title has-text-grey">Reset Password</div>

                    <div class="box has-text-left">

                        @if (session('status'))
                            <p class="help is-large is-success">
                                {{ session('status') }}
                            </p>
                        @endif

                        {{ csrf_field() }}

                        <div class="field">
                            <div class="label">Email Address</div>
                            <div class="control has-icons-left">
                                <input id="email" type="email" class="input" name="email" value="{{ old('email') }}"
                                       required placeholder="Email Address">
                                <span class="icon is-small is-left">
                                <i class="material-icons">email</i>
                            </span>
                            </div>
                        </div>

                        <p class="help is-danger">
                            {{ $errors->first('email') }}
                        </p>

                        <p class="field">
                            <button class="button is-block is-large is-info is-fullwidth">
                                Send Password Reset Link <i class="material-icons right">send</i>
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
