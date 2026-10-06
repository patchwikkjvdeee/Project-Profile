@extends('layouts.app')

@section('title', 'Profiles')

@section('content')
    <h1>Profiles</h1>

    @if ($profiles->isEmpty())
        <div class="empty">
            No profiles yet. <a href="/profiles/create">Add the first one.</a>
        </div>
    @else
        @foreach ($profiles as $profile)
            <div class="item">
                <a href="/profiles/{{ $profile->id }}">{{ $profile->name }}</a>
                <span>{{ $profile->tagline }}</span>
            </div>
        @endforeach
    @endif

    <div class="actions">
        <a class="btn" href="/profiles/create">+ New profile</a>
    </div>

    <h2>Feeling curious?</h2>
    <div class="card">
        <p style="margin: 0 0 1rem;">Jump to a random profile from the directory.</p>
        <a class="btn btn-ghost" href="/spotlight">🎲 Meet someone</a>
    </div>
@endsection