@extends('layouts.app')

@section('title', 'Edit Group')

@section('content')

<div class="flex flex-col items-center justify-center min-h-[80vh] py-10 px-4">
    
    
    <div class="w-full max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
        
        <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-100">
            <h2 class="text-2xl font-bold text-blue-600">⚙️ Edit Group</h2>
        </div>

        <form method="POST" action="{{ route('groups.update', $group->id_group) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Group Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $group->name) }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                <textarea id="description" name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('description', $group->description) }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-4">
                @if($group->picture)
                    <img src="{{ $group->getGroupPicture() }}" class="w-16 h-16 rounded-lg object-cover shadow-sm">
                @endif
                <div class="flex-1">
                    <label for="picture" class="block text-sm font-bold text-gray-700 mb-1">Update Cover Image</label>
                    <input type="file" id="picture" name="picture" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                </div>
            </div>

            <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center h-5">
                    <input type="hidden" name="is_public" value="0">
                    <input id="is_public" name="is_public" type="checkbox" value="1" {{ $group->is_public ? 'checked' : '' }} 
                           class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                </div>
                <div class="ml-3">
                    <label for="is_public" class="font-bold text-gray-800 text-sm">Public Group</label>
                    <p class="text-xs text-gray-500">Control visibility of your group.</p>
                </div>
            </div>

            <div class="flex gap-4 pt-2">
                <button type="submit" class="flex-1 bg-blue-600 text-white py-2.5 px-4 rounded-lg font-bold hover:bg-blue-700 transition shadow-sm">Save Changes</button>
                <a href="{{ route('groups.show', $group->id_group) }}" class="flex-1 bg-white text-gray-700 border border-gray-300 py-2.5 px-4 rounded-lg font-semibold hover:bg-gray-50 transition text-center no-underline">Cancel</a>
            </div>
        </form>

        {{-- DELETE BUTTON --}}
        <div class="mt-8 pt-6 border-t border-red-100">
            <form method="POST" action="{{ route('groups.destroy', $group->id_group) }}" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-50 text-red-600 py-2.5 px-4 rounded-lg font-semibold hover:bg-red-100 transition">
                    Delete Group
                </button>
            </form>
        </div>

    </div>
</div>

@endsection