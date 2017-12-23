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

    <div class="section">
        <div class="container">
            <h3 class="title">Sections</h3>
            <div class="columns">
                <div class="column is-one-quarter">
                    <img src="{{asset('images/sections.png')}}" alt="WordPress Sections">
                </div>
                <div class="column">
                    <p>
                        Sections in KickoffWP correspond directly to sections in you WordPress
                        administration panel.
                    </p>
                    <br>
                    <p>
                        Each section that you create in KickoffWP will create a generated PHP
                        file for you to use in your WordPress Theme. These files are separated
                        so that in the case that you need to modify the PHP code yourself, it
                        is easy to find which file to modify.
                    </p>
                    <br>
                    <p>
                        It is very easy to register your section with your theme. All you need is
                        to import the file into your <strong>functions.php</strong> file and call
                        the static <em>Register</em> function, passing it the <strong>$wp_customize</strong>
                        variable provide by WordPress.
                    </p>
                    <figure class="image howto-image">
                        <img src="{{asset('images/functions-example.png')}}"
                             alt="Example Registration">
                    </figure>
                </div>
            </div>
        </div>
    </div>

@endsection