@extends('layouts.app')

@section('content')

    <div class="section">
        <div class="container">
            <h1 class="title">How to Use KickoffWP</h1>
            <h2 class="subtitle">Everything you need to know.</h2>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <h3 class="title">Themes</h3>
            <div class="columns">
                <div class="column">
                    <p>
                        KickoffWP is designed to be easy to use. To start, simply create a
                        Theme. You can name the theme to be the same as your actual WordPress
                        Theme to keep things organized. Themes on KickoffWP are just a way to
                        keep your sections and settings together.
                    </p>
                    <br>
                    <p>
                        Simply click the button on your start page once you have logged into
                        your account to create a new Theme.
                    </p>
                    <br>
                    <p>
                        Once a Theme is created, you can download all of the section files for
                        that theme at once, instead of each section at a time from the Sections page.
                    </p>
                </div>
                <img src="{{asset('images/create_theme.png')}}" alt="Creating a New Theme">
            </div>
        </div>
    </div>

@endsection