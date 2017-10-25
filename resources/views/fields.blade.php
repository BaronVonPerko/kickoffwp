@extends('layouts.app')

@section('content')
    <fields theme-id="{{$theme->id}}"
            theme-name="{{$theme->name}}"
            section-id="{{$section->id}}"
            section-name="{{$section->name}}"
            fields="{{$fields}}">
    </fields>
@endsection