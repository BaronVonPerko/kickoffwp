@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="content">
            <div class="card columns">
                <div class="column is-6">
                    <h3 class="title has-text-grey">Create New Section</h3>
                    <p>
                        Input the name of your section. This will equate to a customizer page section. The next
                        step will allow you to add controls to this section.
                    </p>
                </div>

                <form class="column is-6" action="/theme/{{$themeId}}/sections" method="post">

                    {{ csrf_field() }}

                    <div class="field">
                        <div class="label">Section Name</div>
                        <div class="control has-icons-left">
                            <input placeholder="Section Name" id="name" name="name" class="input" required autofocus>
                            <span class="icon is-small is-left">
                        <i class="material-icons">list</i>
                    </span>
                        </div>
                    </div>

                    <p class="field">
                        <button class="button is-block is-info is-large is-fullwidth">
                            Create
                        </button>
                    </p>
                </form>
            </div>
        </div>
    </div>



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

        <section-list :sections="{{$sections}}" :theme-id="{{$themeId}}"></section-list>

    @endif

@endsection