@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col s12">
            <div class="card blue darken-1 z-depth-3">
                <div class="card-content white-text">
                    <span class="card-title">Create a new theme</span>
                    <p>
                        Input the name of your theme.  You will create the customizer sections in the next step.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <form class="row" action="/theme" method="post">

        {{ csrf_field() }}

        <div class="col s12">
            <div class="row">
                <div class="input-field col s12 m6 offset-m3">
                    <input type="text" placeholder="Theme Name" id="name" name="name" class="validate" required>
                    <label for="theme_name">Theme Name</label>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m6 offset-m3 text-right">
                    <button type="submit" class="waves-effect waves-light btn-large z-depth-3">Create</button>
                </div>
            </div>
        </div>
    </form>

@endsection