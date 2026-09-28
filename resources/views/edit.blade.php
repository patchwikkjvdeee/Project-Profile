@extends('layouts.app')

@section('title', 'Edit profile')
@section('back', 'yes')

@section('content')
    <h1>Edit your profile ✏️</h1>

    <form class="card" method="POST" action="/edit">
        @csrf

        <label for="name">Name</label>
        <input id="name" name="name" value="{{ old('name', $profile['name']) }}">
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label for="tagline">Tagline</label>
        <input id="tagline" name="tagline" value="{{ old('tagline', $profile['tagline']) }}">

        <label for="bio">About me</label>
        <textarea id="bio" name="bio" rows="4">{{ old('bio', $profile['bio']) }}</textarea>

        <label for="skills">Skills (separate with commas)</label>
        <input id="skills" name="skills" placeholder="HTML, CSS, PHP, Laravel" value="{{ old('skills', implode(', ', $profile['skills'])) }}">

        <label for="email">Email</label>
        <input id="email" name="email" value="{{ old('email', $profile['email']) }}">

        <label for="github">GitHub</label>
        <input id="github" name="github" value="{{ old('github', $profile['github']) }}">

        <label for="city">City</label>
        <input id="city" name="city" value="{{ old('city', $profile['city']) }}">

        <div class="actions">
            <button type="submit">Save profile</button>
            <a class="btn btn-ghost" href="/">Cancel</a>
        </div>
    </form>

    <form method="POST" action="/reset" onsubmit="return confirm('Erase your whole profile?');">
        @csrf
        <button type="submit" class="btn-danger">Reset profile</button>
    </form>
@endsection