@extends('layouts.app')

@section('title', 'Search Page')

@section('content')

<div class="max-w-3xl mx-auto py-10 px-5">

    <div class="mb-5 w-full mx-auto flex justify-between">
        <form id="search-user" action="{{ route('search.users') }}" method="GET" class="relative">
            
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
            
            <input id="search-input-user" type="text" name="search" placeholder="Search by Name or Username..." 
                   class="h-[2em] block w-[50vw] pl-10 pr-24 py-3 border-none rounded-lg shadow-md text-gray-900  bg-white outline-none">
            
        </form>
        <div>
            <i class="fa-solid fa-sliders text-gray-500 mr-2 cursor-pointer mt-2"></i>
        </div>
    </div>
    <div id="users-list" class="space-y-4">
        @foreach($users as $user)
            @include('partials.user-card', ['friend' => $user, 'user' => Auth::user()])
        @endforeach
    </div>
</div>

@endsection