@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<div>
    @auth
        <h1>You are logged in</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Log out</button>
        </form>
    @endauth

    @guest
        <h1>You are a visitor</h1>
        <a href="{{ route('login') }}">
            <button>Log in</button>
        </a>
    @endguest

    </br>

    {{--@if (auth()->check() && auth()->user()->isAdmin())--}}
    <form action="{{ route('admin') }}" method="GET">
        @csrf
        <button type="submit">Admin Page</button>
    </form>
    {{--@endif--}}
</div>

@endsection
