@extends('layouts.app')

@section('title', 'Skills')
@section('back', 'yes')

@section('content')
    <h1>Skills 💪</h1>

    @if (count($profile['skills']) === 0)
        <div class="card">No skills yet. <a href="/edit">Add some on the Edit page.</a></div>
    @else
        <div class="card">
            @foreach ($profile['skills'] as $skill)
                <span class="tag">{{ $skill }}</span>
            @endforeach
        </div>
    @endif
@endsection