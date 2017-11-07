@extends('layouts.app')

@section('content')

    <form class="hero is-fullheight" action="/theme" method="post">
        <div class="hero-body">
            <div class="container has-text-centered">

                <div class="column is-6 is-offset-3">
                    <h3 class="title has-text-grey">Create New Theme</h3>

                    <div class="box has-text-left">

                        {{ csrf_field() }}

                        <div class="field">
                            <div class="label">Theme Name</div>
                            <div class="control has-icons-left">
                                <input placeholder="Theme Name" id="name" name="name" class="input" required autofocus>
                                <span class="icon is-small is-left">
                                    <i class="material-icons">star</i>
                                </span>
                            </div>
                        </div>


                        <p class="field">
                            <button class="button is-block is-info is-large is-fullwidth">
                                Create
                            </button>
                        </p>


                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection