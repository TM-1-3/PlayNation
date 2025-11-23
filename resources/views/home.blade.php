<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body { font-family: sans-serif; text-align: center; margin-top: 50px; }
        button { padding: 10px 20px; cursor: pointer; background-color: #e11d48; color: white; border: none; border-radius: 5px; }
    </style>
</head>
<body>

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

</body>
</html>