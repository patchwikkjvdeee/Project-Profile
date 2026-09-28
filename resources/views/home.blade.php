@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="avatar">{{ mb_strtoupper(mb_substr($profile['name'], 0, 1)) }}</div>

    <h1>Hi, I'm {{ $profile['name'] }} 👋</h1>
    <p class="tagline">{{ $profile['tagline'] }}</p>

    @if ($profile['bio'])
        <div class="card">{{ $profile['bio'] }}</div>
    @endif

    <div class="actions">
        <a class="btn" href="/skills">See my skills</a>
        <a class="btn btn-ghost" href="/contact">Contact me</a>
    </div>
@endsection