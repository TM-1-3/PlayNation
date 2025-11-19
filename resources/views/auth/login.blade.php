<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f3f4f6; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 300px; }
        input { width: 100%; padding: 8px; margin: 8px 0; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #1d4ed8; }
        .error { color: red; font-size: 0.875rem; margin-bottom: 1rem; }
    </style>
</head>
<body>

<div class="card">
    <h2 style="text-align: center;">Login</h2>

    <form method="POST" action="{{ route('login.action') }}">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required autofocus value="{{ old('email') }}">
        </div>

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
</div>

</body>
</html>