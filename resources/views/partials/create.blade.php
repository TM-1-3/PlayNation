@extends('layouts.app')

@section('title', 'Create User')

@section('content')

<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
    <img class="mx-auto mb-6 max-w-[200px]" src="/img/logo.png" alt="Logo">
    <h2 class="text-center text-2xl text-blue-600 mb-6 border-b-2 border-purple-300 pb-2">Create New User</h2>
    <form method="POST" action="{{ route('admin.create.action') }}" class="space-y-4">
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

        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded font-semibold cursor-pointer transition-colors hover:bg-blue-700 mt-6">Create New User</button>
    </form>
</div>

@endsection