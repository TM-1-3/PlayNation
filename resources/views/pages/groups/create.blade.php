@extends('layouts.app')

@section('title', 'Create Group')

@section('content')

<div class="flex flex-col items-center justify-center min-h-[80vh] py-10 px-4">
    
    <div class="w-full max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
        
        <div class="text-center mb-8 pb-4 border-b border-gray-100">
            <h2 class="text-2xl font-bold text-blue-600">🚀 Create a New Group</h2>
        </div>

        <form method="POST" action="{{ route('groups.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Group Name</label>
                <input type="text" id="name" name="name" placeholder="Ex: Porto Runners" required value="{{ old('name') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                <textarea id="description" name="description" placeholder="What is this group about?" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="picture" class="block text-sm font-bold text-gray-700 mb-2">Cover Image</label>
                <input type="file" id="picture" name="picture" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                @error('picture') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center h-5">
                    <input type="hidden" name="is_public" value="0">
                    <input id="is_public" name="is_public" type="checkbox" value="1" {{ old('is_public', true) ? 'checked' : '' }} 
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                </div>
                <div class="ml-3">
                    <label for="is_public" class="font-bold text-gray-800 text-sm">Public Group</label>
                    <p class="text-xs text-gray-500">Anyone can find this group.</p>
                </div>
            </div>

            <div class="flex gap-4 pt-2">
                <button type="submit" class="flex-1 bg-blue-600 text-white py-2.5 px-4 rounded-lg font-bold hover:bg-blue-700 transition shadow-sm">
                    Create Group
                </button>
                <a href="{{ route('groups.index') }}" class="flex-1 bg-white text-gray-700 border border-gray-300 py-2.5 px-4 rounded-lg font-semibold hover:bg-gray-50 transition text-center no-underline">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

@endsection