@extends('layouts.app')

@section('title', 'Recover Password')

@section('content')

<div class="mx-auto bg-white rounded-lg shadow-md p-8 mt-12 w-[60vw]">
    <img class="mx-auto mb-6 max-w-[200px]" src="/img/logo.png" alt="Logo">
    <h2 class="text-center text-2xl text-blue-600 mb-6">Recover Your Password</h2>
    <form method="POST" action="{{ route('recoverPassword.send') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block mb-2 font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" required autofocus value="{{ old('email') }}" class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
        </div>

        @if ($errors->any())
            <div class="text-red-600 text-sm mt-1">
                {{ $errors->first('email') }}
            </div>
        @endif

        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded font-semibold cursor-pointer transition-colors hover:bg-blue-700 mt-6">Send</button>
    </form>
</div>


@endsection
