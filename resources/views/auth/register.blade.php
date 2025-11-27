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

<div class="mx-auto bg-white rounded-lg shadow-md p-8 my-12 w-[70vw]">
    <img class="mx-auto mb-6 max-w-[200px]" src="/img/logo.png" alt="Logo">
    <h2 class="text-center text-2xl text-blue-600 mb-6">Register</h2>
    <form method="POST" action="{{ route('register.action') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block mb-2 font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" required value="{{ old('name') }}" class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
            @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="username" class="block mb-2 font-medium text-gray-700">Username</label>
            <input type="text" id="username" name="username" required value="{{ old('username') }}" class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
            @error('username') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="email" class="block mb-2 font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" required value="{{ old('email') }}" class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
            @error('email') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="password" class="block mb-2 font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" required class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
            @error('password') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block mb-2 font-medium text-gray-700">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded font-semibold cursor-pointer transition-colors hover:bg-blue-700 mt-6">Register</button>
    </form>

    <a href="{{ route('login') }}" class="block text-center mt-4 text-blue-600 no-underline text-sm hover:underline">Already have an account? Login</a>
</div>

@endsection