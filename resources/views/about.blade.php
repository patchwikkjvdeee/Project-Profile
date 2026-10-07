@extends('layouts.app')

@section('title', 'About')

@section('content')
    <h1>About this site</h1>

    <div class="card">
        <p>A small directory of profiles, built with Laravel. Anyone can add their own, view others, and edit or delete their entry.</p>
    </div>

    <h2>What it's built with</h2>
    <div class="card">
        @foreach (['Blade layouts and templating', 'A controller that handles requests', 'An Eloquent model backed by a database', 'Routes with ID parameters for each profile'] as $item)
            <div class="row"><span>{{ $item }}</span></div>
        @endforeach
    </div>
@endsection
