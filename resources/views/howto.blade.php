@extends('layouts.app')

@section('content')

    <div class="section">
        <div class="container">
            <h1 class="title">How to Use KickoffWP</h1>
            <h2 class="subtitle">Everything you need to know.</h2>
            <hr>
            <div class="columns">
                <p class="column">
                    KickoffWP is designed to be easy to use. To start, simply create a
                    Theme. You can name the theme to be the same as your actual WordPress
                    Theme to keep things organized. Themes on KickoffWP are just a way to
                    keep your sections and settings together.
                </p>
                <img src="{{asset('images/create_theme.png')}}" alt="Creating a New Theme">
            </div>
        </div>
    </div>

@endsection