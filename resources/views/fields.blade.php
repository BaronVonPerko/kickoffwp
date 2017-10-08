@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card pink darken-1 z-depth-3">
            <div class="card-content white-text">
                <span class="card-title">Fields for {{$class->theme_name}} {{$class->section_name}}</span>
                <p>
                    Create the fields you would like to display within this Customizer's section.
                </p>
            </div>
            <div class="card-action">
                <a href="#">Create New Field</a>
            </div>
        </div>
    </div>
@endsection