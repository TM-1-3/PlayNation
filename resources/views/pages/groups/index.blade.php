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
                   class="block w-full pl-10 pr-24 py-3 border-none rounded-lg shadow-md text-gray-900 focus:ring-2 focus:ring-blue-500 bg-white outline-none">
            
        </form>
    </div>

    {{-- group grid --}}
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($groups as $group)
            {{-- A TUA CLASSE: bg-white rounded-lg shadow-md --}}
            <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                
                {{-- Imagem --}}
                <div class="h-40 overflow-hidden relative">
                    <img src="{{ $group->picture ? asset($group->picture) : asset('img/default-group.png') }}" 
                         alt="{{ $group->name }}" 
                         class="w-full h-full object-cover">
                    
                    {{-- Badge --}}
                    <div class="absolute top-2 right-2">
                        @if($group->is_public)
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded shadow-sm">Public</span>
                        @else
                            <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded shadow-sm"><i class="fa-solid fa-lock text-[10px] mr-1"></i>Private</span>
                        @endif
                    </div>
                </div>
                
                <div class="p-5 flex-1 flex flex-col">
                    <h3 class="text-xl font-bold mb-2 text-gray-800 truncate">{{ $group->name }}</h3>
                    
                    <p class="text-gray-600 text-sm mb-4 flex-1 line-clamp-3">
                        {{ $group->description ?? 'No description available.' }}
                    </p>

                    <a href="{{ route('groups.show', $group->id_group) }}" class="mt-auto block w-full text-center text-blue-600 border border-blue-600 py-2 rounded-lg hover:bg-blue-50 transition font-medium no-underline">
                        View Group
                    </a>
                </div>
            </article>
        @empty
            <div class="col-span-full mx-auto bg-white rounded-lg shadow-md p-10 text-center text-gray-500">
                <i class="fa-solid fa-users-slash text-4xl mb-4 text-gray-300"></i>
                <p class="text-lg">No groups found.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection