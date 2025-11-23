<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
</head>
<body>

<div class="card">
    <h2 style="text-align: center;">Login</h2>

    <form method="POST" action="{{ route('login.action') }}">
        @csrf

        <div>
        <label for="login">Email or Username</label>
        <input type="text" id="login" name="usernameEmail" required autofocus value="{{ old('login') }}">

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first('email') }}
            </div>
        @endif

        <button type="submit">Log in</button>
    </form>
    <a href="{{ route('register') }}" style="display: block; text-align: center; margin-top: 15px; color: #2563eb; text-decoration: none; font-size: 0.9rem;">
        Don't have an account? Register
    </a>
    <a href="{{ route('home') }}" class="link" style="color: #6b7280; margin-top: 10px;">
        Continue without logging in
    </a>
</div>

</body>
</html>