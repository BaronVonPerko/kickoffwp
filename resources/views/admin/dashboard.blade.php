@extends('layouts.app')

@section('content')

    <div class="content">
        <h1>Admin Dashboard</h1>

        <section class="section">
            <p>Registered Users: {{$numUsers}}</p>
            <p>Themes: {{$activeThemes}} / {{$totalThemes}}</p>
            <p>Sections: {{$activeSections}} / {{$totalSections}}</p>
            <p>Fields: {{$activeFields}} / {{$totalFields}}</p>
        </section>
    </div>

@endsection