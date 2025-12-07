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

<div class="mx-auto bg-white rounded-lg shadow-md p-8 mt-12 w-[60vw]">
    <img class="mx-auto mb-6 max-w-[200px]" src="/img/logo.png" alt="Logo">
    <h2 class="text-center text-2xl text-blue-600 mb-6">Login</h2>
    <form method="POST" action="{{ route('login.action') }}" class="space-y-4">
        @csrf

        <div>
            <label for="login" class="block mb-2 font-medium text-gray-700">Email or Username</label>
            <input type="text" id="login" name="usernameEmail" required autofocus value="{{ old('login') }}" class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
        </div>

        <div>
            <label for="password" class="block mb-2 font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" required class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
        </div>

        @if ($errors->any())
            <div class="text-red-600 text-sm mt-1">
                {{ $errors->first('email') }}
            </div>
        @endif

        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded font-semibold cursor-pointer transition-colors hover:bg-blue-700 mt-6">Log in</button>
    </form>
    <a href="{{ route('register') }}" class="block text-center mt-4 text-blue-600 no-underline text-sm hover:underline">
        Don't have an account? Register
    </a>
    <a href="{{ route('recoverPassword') }}" class="block text-center mt-2.5 text-black-500 no-underline text-sm hover:underline">
        Forgot The Password?
    </a>
    <a href="{{ route('home') }}" class="block text-center mt-2.5 text-gray-500 no-underline text-sm hover:underline">
        Continue without logging in
    </a>
</div>


@endsection
