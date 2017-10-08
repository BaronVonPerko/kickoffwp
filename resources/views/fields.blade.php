@extends('layouts.app')

@section('content')
    <fields theme="{{$class->theme_name}}" section="{{$class->section_name}}" id="{{$class->id}}"></fields>
@endsection