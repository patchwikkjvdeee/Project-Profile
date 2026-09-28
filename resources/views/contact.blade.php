@extends('layouts.app')

@section('title', 'Contact')
@section('back', 'yes')

@section('content')
    <h1>Say hello 📬</h1>

    <div class="card">
        @if ($profile['email'])
            <div class="row"><span>Email</span><span>{{ $profile['email'] }}</span></div>
        @endif
        @if ($profile['github'])
            <div class="row"><span>GitHub</span><span>{{ $profile['github'] }}</span></div>
        @endif
        @if ($profile['city'])
            <div class="row"><span>City</span><span>{{ $profile['city'] }}</span></div>
        @endif

        @if (! $profile['email'] && ! $profile['github'] && ! $profile['city'])
            No contact info yet. <a href="/edit">Add it on the Edit page.</a>
        @endif
    </div>
@endsection