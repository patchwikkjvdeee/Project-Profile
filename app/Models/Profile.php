@extends('layouts.app')

@section('title', 'New profile')

@section('content')
    <h1>New profile</h1>

    <form class="card" method="POST" action="/profiles">
        @csrf

        <label for="name">Name</label>
        <input id="name" name="name">
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label for="tagline">Tagline</label>
        <input id="tagline" name="tagline" placeholder="A short line about you">

        <label for="bio">About</label>
        <textarea id="bio" name="bio" rows="4" placeholder="A few sentences about yourself"></textarea>

        <label for="skills">Skills (separate with commas)</label>
        <input id="skills" name="skills" placeholder="HTML, CSS, PHP, Laravel">

        <label for="fun_fact">Fun fact</label>
        <input id="fun_fact" name="fun_fact" placeholder="I once named a rubber duck and gave it a LinkedIn.">

        <label for="email">Email</label>
        <input id="email" name="email" placeholder="you@example.com">

        <label for="github">GitHub</label>
        <input id="github" name="github" placeholder="yourusername">

        <label for="city">City</label>
        <input id="city" name="city" placeholder="Your City">

        <div class="actions">
            <button type="submit">Save profile</button>
            <a class="btn btn-ghost" href="/">Cancel</a>
        </div>
    </form>
@endsection
