@component('mail::message')
# Kickoff Nightly Status Report

{{$count}} new emails signed up today!

@foreach($emails as $email)
    * {{$email->email}}
@endforeach

@endcomponent
