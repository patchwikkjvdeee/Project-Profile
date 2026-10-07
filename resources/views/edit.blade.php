@extends('layouts.app')

@section('title', 'Edit profile')

@section('content')
    <h1>Edit {{ $profile->name }}</h1>

    <form id="edit-form" class="card" method="POST" action="/profiles/{{ $profile->id }}">
        @csrf

        <label for="name">Name</label>
        <input id="name" name="name" placeholder="{{ $profile->name }}">
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label for="tagline">Tagline</label>
        <input id="tagline" name="tagline" placeholder="{{ $profile->tagline ?: 'A short line about you' }}">

        <label for="bio">About</label>
        <textarea id="bio" name="bio" rows="4" placeholder="{{ $profile->bio ?: 'A few sentences about yourself' }}"></textarea>

        <label for="skills">Skills (separate with commas)</label>
        <input id="skills" name="skills" placeholder="{{ $profile->skills ? implode(', ', $profile->skills) : 'HTML, CSS, PHP, Laravel' }}">

        <label for="fun_fact">Fun fact</label>
        <input id="fun_fact" name="fun_fact" placeholder="{{ $profile->fun_fact ?: 'I once named a rubber duck and gave it a LinkedIn.' }}">

        <label for="email">Email</label>
        <input id="email" name="email" placeholder="{{ $profile->email ?: 'you@example.com' }}">

        <label for="github">GitHub</label>
        <input id="github" name="github" placeholder="{{ $profile->github ?: 'yourusername' }}">

        <label for="city">City</label>
        <input id="city" name="city" placeholder="{{ $profile->city ?: 'Your City' }}">

        <div class="actions">
            <button type="submit">Save changes</button>
            <a class="btn btn-ghost" href="/profiles/{{ $profile->id }}">Cancel</a>
        </div>
    </form>

    <script>
        document.getElementById('clear-btn').addEventListener('click', function () {
            document.getElementById('edit-form').querySelectorAll('input, textarea').forEach(function (field) {
                field.value = '';
            });
        });
    </script>
@endsection