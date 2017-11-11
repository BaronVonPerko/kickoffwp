@extends('layouts.app')

@section('content')

    <div class="container">
    @auth
        <div class="content">
            <div class="column has-text-centered">
                <h1 class="title">Welcome, {{Auth::user()->name}}!</h1>
            </div>
        </div>
    @endauth

    <div class="content">
        <div class="columns">

            @guest
            @include('profile.anonymousCard')
            @endguest

            <div class="column">
                <div class="card">
                    <div class="card-header">
                        @if($themes->count() == 0)
                            <span class="card-header-title">Ready to get started?</span>
                        @else
                            <span class="card-header-title">Keep creating!</span>
                        @endif
                    </div>
                    <div class="card-content">
                        @if($themes->count() == 0)
                        <p>
                            Create a theme to manage all of your customizer files.
                            Don't worry, the files can easily be copied to other themes later!
                        </p>
                        @else
                            <p>
                                Want to create more customizer files for your themes?
                            </p>
                        @endif
                    </div>
                    <div class="card-footer">
                        <a href="/theme/create" class="button is-primary card-footer-item">Create a new theme</a>
                    </div>
                </div>
            </div>

            @auth
                <div class="column is-two-thirds">
                    @if($themes->count() == 0)
                        <em>You don't have anything saved.</em>
                    @else
                        <div>
                            <span class="card-header-title">Continue working on your existing customizer classes</span>
                        </div>
                        <div class="">
                            <theme-list :themes="{{$themes}}"></theme-list>
                        </div>
                    @endif
                </div>
            @endauth

        </div>
    </div>
@endsection