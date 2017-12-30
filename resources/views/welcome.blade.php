@extends('layouts.app')

@section('content')

    <div class="container-fluid is-light is-full-height hero-pattern">
        <section class="hero">
            <div class="hero-body">
                <div class="container">
                    <div class="columns is-tablet">
                        <div class="column is-7">
                            <img class="responsive-img" src="{{asset('images/functions-example.png')}}" alt="">
                        </div>
                        <div class="column is-5">
                            <h1 class="title">Kick off your WordPress Theme Customizer Files.</h1>
                            <h2 class="subtitle">
                                Building customizer classes is tedious and takes time.
                                KickoffWP does it for you quickly, easily, and for free!
                            </h2>

                            <div class="field">
                                <div class="control has-text-centered">
                                    <a href="/register">
                                        <button class="button is-large is-primary">
                                            Register for FREE
                                        </button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection