@extends('layouts.app')

@section('title', 'Register')

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

@endsection