@extends('layouts.app')

@section('title', 'Login')

<!-- removi estas declrações de doctype e head e metadata porque já temos uma genenralização com o blade no extends(layouts.app) então assim fica tudo mais homogéneo
     adicionei também o rodapé e cabeçalo para ficar consistente sitewide e se se mudar num muda tudo ao mesmo tempo
     mantive as tuas lógicas todas 
     mantive a logica do form
     as rotas apontam para os mesmos controllers
     mantive o csrf
     os inputs também estão iguaisinhos
     e a tua lógica de erros -->

@section('content')

<div class="card">
    <img class="logo" src = "/img/logo.png">
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


@endsection
