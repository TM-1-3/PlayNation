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
            <i class="fa-solid fa-sliders text-gray-500 mr-2"></i>
        </div>
    </div>
    <div id="users-list" class="space-y-4">
        @foreach($users as $user)
        <div class="flex bg-white border border-gray-200 rounded-lg p-5 transition-all hover:shadow-md hover:border-blue-400">
            <a href="{{ route('profile.show', $user->id_user) }}" class="mt-2 mr-1">
                <img class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5" 
                    src="{{ $user->getProfileImage() }}" 
                    alt="avatar">
            </a>
            <div class="flex-col">
                <a href="{{ route('profile.show',$user->id_user) }}" class="block text-lg font-semibold text-gray-800 no-underline transition-colors hover:text-blue-600">{{ $user->name }}</a>
                <a href="{{ route('profile.show',$user->id_user) }}" class="block text-sm text-gray-500 no-underline transition-colors hover:text-blue-500 ">
                    {{ $user->username }}
                    @if($user->verifiedUser)
                        <i class="fa-solid fa-circle-check text-blue-500 text-lg" title="Verified Account"></i>
                    @endif
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection