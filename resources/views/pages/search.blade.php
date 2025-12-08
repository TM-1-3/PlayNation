@extends('layouts.app')

@section('title', 'Search Page')

@section('content')

<div class="max-w-3xl mx-auto py-10 px-5">
    <form id="search-user" action="{{ route('search.users') }}" method="GET" class="mb-6">
        <input id="search-input-user" type="text" name="search" placeholder="Search by Name or Username..." class="w-full py-3.5 px-4 border-2 border-gray-200 rounded-lg text-base mb-4 transition-all focus:outline-none focus:border-blue-500 focus:shadow-[0_0_0_3px_rgba(52,152,219,0.1)] h-[2em]">
    </form>
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