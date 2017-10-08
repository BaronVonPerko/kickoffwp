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
                    <a href="/new" class="black-text">Create a new class</a>
                </div>
            </div>
        </div>
    </div>

    @auth
        @if($customizers->count() == 0)
        <div class="row">
            <div class="col s12 center-align">
                <em>You don't have anything saved.</em>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col sm12">
                    <h5>Continue working on your existing customizer classes</h5>
                </div>
            </div>
            <div class="row">
            @foreach($customizers as $customizer)
                <div class="col s6 m4">
                    <div class="card green lighten-3 z-depth-3">
                        <div class="card-content black-text">
                            <span class="card-title">{{$customizer->theme_name}}</span>
                            <p>
                                {{$customizer->section_name}}
                            </p>
                        </div>
                        <div class="card-action">
                            <a href="/fields/{{$customizer->id}}" class="black-text">Edit Fields</a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @endif
    @endauth

@endsection