<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
</head>
<body>

<div class="card">
    <img class="logo" src = "/img/logo.png">
    <h2 style="text-align: center;">Register</h2>
    <form method="POST" action="{{ route('register.action') }}">
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

        <button type="submit">Register</button>
    </form>

    <a href="{{ route('login') }}" class="link">Already have an account? Login</a>
</div>

</body>
</html>