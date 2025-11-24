@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<div class="centered-content">
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
</div>

@endsection
