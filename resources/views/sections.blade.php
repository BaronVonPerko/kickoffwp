@extends('layouts.app')

@section('content')
    
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card blue darken-1 z-depth-3">
                <div class="card-content white-text">
                    <span class="card-title">Create a new customizer section</span>
                    <p>
                        Input the name of your section. This will equate to a customizer page section. The next
                        step will allow you to add controls to this section.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <form class="row" action="/theme/{{$themeId}}/sections" method="post">

        {{ csrf_field() }}

        <div class="col s12">
            <div class="row">
                <div class="input-field col s12 m6 offset-m3">
                    <input type="text" placeholder="Section Name" id="name" name="name" class="validate" required>
                    <label for="theme_name">Section Name</label>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m6 offset-m3 text-right">
                    <button type="submit" class="waves-effect waves-light btn-large z-depth-3">Create</button>
                </div>
            </div>
        </div>
    </form>

    @if($sections->count() != 0)

        <div class="row">
            <div class="col s12">
                <div class="card blue darken-1 z-depth-3">
                    <div class="card-content white-text">
                        <span class="card-title">Existing sections</span>
                        <p>
                            Below are the existing sections for your theme. Edit the section information, the fields,
                            or even copy the section to another theme.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($sections as $section)
            <div class="col s12 l6">
                <div class="card green lighten-3 z-depth-3">
                    <div class="card-content">
                        <span class="card-title">{{$section->name}}</span>
                    </div>
                    <div class="card-action">
                        <a href="/theme/{{$themeId}}/sections/{{$section->id}}/fields" class="black-text">Fields</a>
                        <a href="#" class="black-text">Edit</a>
                        <a href="#" class="black-text">Copy</a>
                        <a href="#" class="black-text">Delete</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    @endif

@endsection