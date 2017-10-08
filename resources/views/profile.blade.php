@extends('layouts.app')

@section('content')

    @auth
        <div class="row">
            <div class="col sm12">
                <h5>Welcome back, {{Auth::user()->name}}!</h5>
            </div>
        </div>
    @else
        @include('profile.anonymousCard')
    @endauth

    <div class="row">
        <div class="col s12">
            <div class="card orange darken-1 z-depth-3">
                <div class="card-content white-text">
                    <span class="card-title">Ready to get started?</span>
                    <p>
                        Step through easy to follow options to create a custom
                        object-oriented class file for your WordPress theme.
                    </p>
                </div>
                <div class="card-action">
                    <a href="/new" class="black-text">Let's Go!</a>
                </div>
            </div>
        </div>
    </div>

    @auth
        <div class="row">
            <div class="col s12 center-align">
                <em>You don't have anything saved.</em>
            </div>
        </div>
    @endauth

@endsection