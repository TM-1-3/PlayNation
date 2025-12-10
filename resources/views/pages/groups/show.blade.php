@extends('layouts.app')

@section('title', $group->name)

@section('content')

<div class="max-w-6xl mx-auto pt-10 pr-5 pb-5">
    <div class="flex flex-wrap gap-8">
        
        {{-- left info --}}
        <div class="w-full md:w-1/3 md:min-w-[280px]">
            
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-5">
                
                <div class="relative w-full h-48 mb-6 rounded-lg overflow-hidden shadow-sm">
                    <img src="{{ $group->getGroupPicture() }}" 
                         alt="{{ $group->name }}" 
                         class="w-full h-full object-cover">
                </div>
                
                <div class="text-center mb-4">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $group->name }}</h1>
                    
                    @if($group->is_public)
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Public Group</span>
                    @else
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">Private Group</span>
                    @endif
                </div>

                <p class="text-gray-600 italic text-center mb-6 text-sm">
                    "{{ $group->description ?? 'No description.' }}"
                </p>

                <div class="flex justify-center gap-8 mb-6 border-t border-gray-100 pt-4">
                    <div class="text-center">
                        <span class="block text-xl font-bold text-blue-600">{{ $group->members->count() }}</span>
                        <span class="text-xs text-gray-500 uppercase">Members</span>
                    </div>
                    <div class="text-center">
                        <span class="block text-xl font-bold text-blue-600">0</span>
                        <span class="text-xs text-gray-500 uppercase">Posts</span>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    @if(Auth::check() && (Auth::id() === $group->id_owner || Auth::user()->isAdmin()))
                        <a href="{{ route('groups.edit', $group->id_group) }}" class="w-full bg-gray-50 text-gray-700 py-2 rounded-lg hover:bg-gray-100 transition font-medium text-center no-underline border border-gray-200">
                            Edit Group
                        </a>
                    @endif

                    <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-medium shadow-sm">
                        Join Group
                    </button>
                </div>
            </div>
        </div>

        {{-- right Feed --}}
        <div class="flex-1 min-w-0">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Group Activity</h3>
                
                <div class="text-center py-10 bg-gray-50 rounded-lg">
                    <p class="text-gray-500">No posts in this group yet.</p>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection