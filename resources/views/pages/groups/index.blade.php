@extends('layouts.app')

@section('title', 'Groups')

@section('content')

<div class="max-w-6xl mx-auto">
    
    {{-- header n search--}}
    <div class="fixed bg-gray-50 p-5 pb-2 pr-10 z-50 w-6xl">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <h2 class="text-3xl font-bold text-gray-800">Groups</h2>
        
        {{-- searchbar --}}
        <div class="flex gap-5 items-center">
            <form id="search-group" action="{{ route('search.groups') }}" method="GET" class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>
                <input type="text" name="search" id="group-search" placeholder="Search for groups..." 
                    class="h-[2em] w-full md:w-[500px] pl-10 pr-4 py-2.5 border-none rounded-lg shadow-md text-gray-900 bg-white outline-none">
            </form>

            <button id="filter-toggle" class="flex items-center" aria-expanded="false" aria-controls="filter-panel">
                <i class="fa-solid fa-sliders text-gray-500 cursor-pointer"></i>
            </button>
        </div>

        @auth
            <a href="{{ route('groups.create') }}" class="bg-blue-600 text-white py-2.5 px-5 rounded-lg hover:bg-blue-700 transition flex items-center gap-2 no-underline font-semibold shadow-md text-sm whitespace-nowrap" title="Create new group">
                <i class="fa-solid fa-plus"></i> New Group
            </a>
        @endauth
    </div>
    </div>

    <div id="main-container" class="pt-20 p-5">
    @auth
        {{-- my groups--}}
        @if($myGroups->isNotEmpty())
            <div class="mb-12 group-section">
                <h3 class="text-xl font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-user-group text-blue-500"></i> My Groups
                </h3>
                
                <div class="flex flex-wrap gap-5 justify-start" id="my-groups-grid">
                    @foreach($myGroups as $group)
                        @include('partials.group-card', ['group' => $group])
                    @endforeach
                </div>
            </div>
        @endif
    @endauth

    {{-- explore --}}
    <div class="group-section">
        <h3 class="text-xl font-bold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-regular fa-compass text-blue-500"></i> Explore
        </h3>

        @if($otherGroups->isEmpty())
            <div class="bg-white rounded-lg shadow-sm p-8 text-center text-gray-500">
                <p>No more groups to discover right now.</p>
            </div>
        @else
            <div class="flex flex-wrap gap-5 justify-start" id="other-groups-grid">
                @foreach($otherGroups as $group)
                    @include('partials.group-card', ['group' => $group])
                @endforeach
            </div>
        @endif
        
        {{-- no results message --}}
        <div id="no-results" class="hidden text-center py-10 text-gray-400">
            <i class="fa-solid fa-filter-circle-xmark text-4xl mb-2"></i>
            <p>No groups found matching your filter.</p>
        </div>
    </div>
    </div>

    @include('partials.filter-groups')

</div>

@endsection