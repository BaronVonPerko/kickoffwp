@extends('layouts.app')

@section('content')
    <fields theme="{{$class->theme_name}}" section="{{$class->section_name}}"></fields>
@endsection