<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - LBAW</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f3f4f6; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 350px; }
        input { width: 100%; padding: 8px; margin: 8px 0; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #1d4ed8; }
        .link { display: block; text-align: center; margin-top: 15px; color: #2563eb; text-decoration: none; font-size: 0.9rem; }
        .error { color: red; font-size: 0.8rem; margin-bottom: 5px; }
    </style>
</head>
<body>

<div class="card">
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