@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col s12">
            <div class="card blue darken-1 z-depth-3">
                <div class="card-content white-text">
                    <span class="card-title">Create a new customizer class</span>
                    <p>
                        Input the name of your theme and the new section to be created.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <form class="row">
        <div class="col s12">
            <div class="row">
                <div class="input-field col s12 m6">
                    <input type="text" placeholder="Theme Name" id="theme_name" class="validate" required>
                    <label for="theme_name">Theme Name</label>
                </div>

                <div class="input-field col s12 m6">
                    <input type="text" placeholder="Section Name" id="section_name" class="validate" required>
                    <label for="section_name">Section Name</label>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <button type="submit" class="waves-effect waves-light btn-large z-depth-3">Create</button>
                </div>
            </div>
        </div>
    </form>

@endsection