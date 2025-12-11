@extends('layouts.app')

@section('title', $title ?? 'Groups')

@section('content')

<div class="max-w-6xl mx-auto p-5">

    <div class="flex flex-wrap justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800">{{ $title ?? 'Groups' }}</h2>
        
        @auth
            <a href="{{ route('groups.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition flex items-center gap-2 no-underline font-semibold shadow-sm">
                <i class="fa-solid fa-plus"></i> Create Group
            </a>
        @endauth
    </div>

    {{-- search bar --}}
    <div class="mb-16 max-w-2xl mx-auto">
        <form action="{{ route('groups.index') }}" method="GET" class="relative">
            
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
            
            {{-- Adicionei 'pl-10' nas classes abaixo para o texto não tapar a lupa --}}
            <input type="text" name="search" placeholder="Search for groups..." value="{{ request('search') }}" 
                   class="h-[2em] block w-full pl-10 pr-24 py-3 border-none rounded-lg shadow-md text-gray-900 bg-white outline-none">
            
        </form>
    </div>

    {{-- group grid --}}
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($groups as $group)
            @include('partials.group-card', ['group' => $group])
        @empty
            <div class="col-span-full mx-auto bg-white rounded-lg shadow-md p-10 text-center text-gray-500">
                <i class="fa-solid fa-users-slash text-4xl mb-4 text-gray-300"></i>
                <p class="text-lg">No groups found.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection