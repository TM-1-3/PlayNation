@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<div class="mx-auto bg-white rounded-lg shadow-md p-8 mt-12 w-[60vw]">
    <img class="mx-auto mb-6 max-w-[200px]" src="/img/logo.png" alt="Logo">
    <h2 class="text-center text-2xl text-blue-600 mb-6">Reset Password</h2>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
        @csrf

        <input type="hidden" name="token" value="{{$token}}">
        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

        <div>
            <label for="password" class="block mb-2 font-medium text-gray-700">New Password</label>
            <input type="password" id="password" name="password" required autofocus
                   class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
        </div>
        <div>
            <label for="password_confirmation" class="block mb-2 font-medium text-gray-700">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required 
                   class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
        </div>

        @if ($errors->any())
            <div class="text-red-600 text-sm mt-1">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded font-semibold cursor-pointer transition-colors hover:bg-blue-700 mt-6">
            Reset Password
        </button>
    </form>
</div>

@endsection