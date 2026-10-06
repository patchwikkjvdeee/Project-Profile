@extends('layouts.app')

@section('title', $profile->name)

@section('content')
    <div class="avatar">{{ mb_strtoupper(mb_substr($profile->name, 0, 1)) }}</div>

    <h1>{{ $profile->name }}</h1>
    <p class="tagline">{{ $profile->tagline }}</p>

    @if ($profile->bio)
        <div class="card">{{ $profile->bio }}</div>
    @endif

    <h2>Skills</h2>
    @if (count($profile->skills ?? []) === 0)
        <div class="card">No skills listed.</div>
    @else
        <div class="card">
            @foreach ($profile->skills as $skill)
                <span class="tag">{{ $skill }}</span>
            @endforeach
        </div>
    @endif

    <h2>Contact</h2>
    <div class="card">
        @if ($profile->email)
            <div class="row"><span>Email</span><span>{{ $profile->email }}</span></div>
        @endif
        @if ($profile->github)
            <div class="row"><span>GitHub</span><span>{{ $profile->github }}</span></div>
        @endif
        @if ($profile->city)
            <div class="row"><span>City</span><span>{{ $profile->city }}</span></div>
        @endif
    </div>

    @if ($profile->fun_fact)
        <h2>Fun fact</h2>
        <div class="card">{{ $profile->fun_fact }}</div>
    @endif

    <div class="actions">
        <a class="btn btn-ghost" href="/profiles/{{ $profile->id }}/edit">Edit</a>
        <a class="btn btn-ghost" href="/">Back to list</a>
        <form method="POST" action="/profiles/{{ $profile->id }}/delete" onsubmit="return confirm('Delete this profile?');">
            @csrf
            <button type="submit" class="btn-danger">Delete</button>
        </form>
    </div>
@endsection