@extends('layouts.app')

@section('content')

    <div class="container-fluid is-light is-full-height hero-pattern">
        <section class="hero">
            <div class="hero-body">
                <div class="columns is-tablet">
                    <div class="column is-7">
                        <img class="responsive-img" src="{{asset('images/code-screenshot.png')}}" alt="">
                    </div>
                    <div class="column is-5">
                        <h1 class="title">Kick off your WordPress customizer files.</h1>
                        <h2 class="subtitle">
                            Building customizer classes is tedious and takes time KickoffWP does it for
                            you quickly and easily.
                        </h2>

                        <welcome-email-signup></welcome-email-signup>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection