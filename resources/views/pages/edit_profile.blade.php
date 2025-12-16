@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<div class="flex flex-col items-center justify-center text-center min-h-[60vh] pb-5">
    <div class="w-full max-w-2xl bg-white rounded-lg shadow-md p-8 text-left">
        <h2 class="text-2xl text-blue-500 font-semibold border-b-2 border-gray-200 pb-2 mb-6">
            ✏️ Edit Profile
        </h2>

        <form method="POST" action="{{ route('profile.update', $user->id_user) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            
            @if(isset($fromAdmin) && $fromAdmin)
                <input type="hidden" name="from_admin" value="1">
            @endif

            <div>
                <label for="name" class="block mb-2 font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="username" class="block mb-2 font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
                @error('username') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block mb-2 font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="biography" class="block mb-2 font-medium text-gray-700">Biography</label>
                <textarea id="biography" name="biography" class="h-[100px] w-full p-3 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">{{ old('biography', $user->biography) }}</textarea>
            </div>

            <div>
                <label for="profile_picture" class="block mb-2 font-medium text-gray-700">Profile Picture</label>
                <input type="file" id="profile_picture" name="profile_picture" class="w-full p-2 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
                @error('profile_picture') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <hr class="my-6 border-gray-300">

            <h4 class="mt-4 text-lg font-semibold text-gray-700">Change Password <small class="text-xs text-gray-500">(Leave empty to keep current)</small></h4>
            
            <div>
                <label for="password" class="block mb-2 font-medium text-gray-700">New Password</label>
                <input type="password" id="password" name="password" autocomplete="new-password" class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block mb-2 font-medium text-gray-700">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
            </div>

            <hr class="my-6 border-gray-300">

            <div class="my-5 flex items-center">
                <input type="checkbox" id="is_public" name="is_public" value="1" {{ $user->is_public ? 'checked' : '' }} class="mr-2.5 w-4 h-4">
                <label for="is_public" class="m-0 inline font-medium text-gray-700">Make Profile Public?</label>
            </div>
            <p class="text-sm text-gray-500">If unchecked, only friends can see your posts.</p>

            <div class="mt-8 flex gap-2.5">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center border border-blue-500 transition-colors hover:bg-blue-500">💾 Save Changes</button>
                @if(isset($fromAdmin) && $fromAdmin)
                    <a href="{{ route('admin') }}" class="bg-transparent text-blue-500 border border-blue-500 py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center transition-colors hover:bg-blue-500 hover:text-white">Cancel</a>
                @else
                    <a href="{{ route('profile.show', $user->id_user) }}" class="bg-transparent text-blue-500 border border-blue-500 py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center transition-colors hover:bg-blue-500 hover:text-white">Cancel</a>
                @endif
            </div>

        </form>
    </div>
</div>

@endsection