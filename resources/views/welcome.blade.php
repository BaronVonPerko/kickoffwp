@extends('layouts.app')

@section('content')
    <div class="row hero-section">
        <div class="col s12 m7">
            <img class="responsive-img" src="{{asset('images/code-screenshot.png')}}" alt="">
        </div>

        <div class="col s12 m5 center-align">
            <h2>Kick off your WordPress customizer files.</h2>
            <h5>
                Building customizer classes is tedious and takes time. KickoffWP
                does it for you quickly and easily.
            </h5>
            {{--<a href="#" class="waves-effect waves-light btn-large pulse z-depth-3">Coming Soon!</a>--}}

            <welcome-email-signup></welcome-email-signup>
        </div>
    </div>
@endsection