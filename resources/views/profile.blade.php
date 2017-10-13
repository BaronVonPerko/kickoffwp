@extends('layouts.app')

@section('content')

    @auth
        <div class="row">
            <div class="col sm12">
                <h5>Welcome, {{Auth::user()->name}}!</h5>
            </div>
        </div>
    @else
        @include('profile.anonymousCard')
    @endauth

    <div class="row">
        <div class="col s12">
            <div class="card orange darken-1 z-depth-3">
                <div class="card-content white-text">
                    <span class="card-title">Ready to get started?</span>
                    <p>
                        Create a theme to manage all of your customizer files.
                        Don't worry, the files can easily be copied to other themes later!
                    </p>
                </div>
                <div class="card-action">
                    <a href="/theme/create" class="black-text">Create a new theme</a>
                </div>
            </div>
        </div>
    </div>

    @auth
        @if($themes->count() == 0)
        <div class="row">
            <div class="col s12 center-align">
                <em>You don't have anything saved.</em>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col sm12">
                    <h5>Continue working on your existing customizer classes</h5>
                </div>
            </div>
            <div class="row">
            @foreach($themes as $theme)
                <div class="col s12 m6">
                    <div class="card green lighten-3 z-depth-3">
                        <div class="card-content black-text">
                            <span class="card-title">{{$theme->name}}</span>
                            <ul class="row">
                                @forelse($theme->sections as $section)
                                    <li class="col s6">
                                        <a href="/theme/{{$theme->id}}/sections/{{$section->id}}/fields">
                                            {{$section->name}}
                                        </a>
                                    </li>
                                @empty
                                    <li class="col s12"><em>No sections created</em></li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="card-action">
                            <a href="/theme/{{$theme->id}}/sections" class="black-text">Sections</a>
                            <a href="#" class="black-text">Edit</a>
                            <a href="#" class="black-text">Copy</a>
                            <a href="#" class="black-text">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @endif
    @endauth

@endsection