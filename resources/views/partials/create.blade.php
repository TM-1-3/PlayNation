@extends('layouts.app')

@section('title', 'Create User')

@section('content')

<div class="card">
    <img class="logo" src = "/img/logo.png">
    <h2 style="text-align: center;">Create New User</h2>
    <form method="POST" action="{{ route('admin.create.action') }}">
        @csrf

        <label for="name">Name</label>
        <input type="text" id="name" name="name" required value="{{ old('name') }}">
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required value="{{ old('username') }}">
        @error('username') <div class="error">{{ $message }}</div> @enderror

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required value="{{ old('email') }}">
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <button type="submit">Create New User</button>
    </form>
</div>

@endsection