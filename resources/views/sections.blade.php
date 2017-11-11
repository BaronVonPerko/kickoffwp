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

        <div class="container">
            <div class="content">
                <div class="card columns">
                    <div class="column is-6">
                        <section-list :sections="{{$sections}}" :theme-id="{{$themeId}}"></section-list>
                    </div>
                    <div class="column is-6">
                        <h3 class="title has-text-grey">Existing Sections</h3>
                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection