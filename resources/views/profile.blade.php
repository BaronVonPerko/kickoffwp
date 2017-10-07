@extends('layouts.app')

@section('content')

    @if($user != null)
        <h1>you are signed in</h1>
    @else
        <h1>you need an account</h1>
    @endif

@endsection