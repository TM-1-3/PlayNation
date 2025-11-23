@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="row">
    <div class="column column-50 column-offset-25">
        
        <div class="card" style="margin-top: 2em; padding: 2em;">
            <h2 style="text-align: center; color: #9b4dca;">Register</h2>

            
            <form method="POST" action="{{ route('register.action') }}">
                @csrf

                <label for="name">Name</label>
                <input type="text" id="name" name="name" required value="{{ old('name') }}">
                @error('name') <div class="error" style="color: red;">{{ $message }}</div> @enderror

                <label for="username">Username</label>
                <input type="text" id="username" name="username" required value="{{ old('username') }}">
                @error('username') <div class="error" style="color: red;">{{ $message }}</div> @enderror

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}">
                @error('email') <div class="error" style="color: red;">{{ $message }}</div> @enderror

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password') <div class="error" style="color: red;">{{ $message }}</div> @enderror

                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>

                <button type="submit" class="button button-block" style="width: 100%;">Register</button>
            </form>

            <div style="text-align: center; margin-top: 15px;">
                <a href="{{ route('login') }}" class="link" style="color: #9b4dca;">
                    Already have an account? Login
                </a>
            </div>
        </div>

    </div>
</div>

@endsection