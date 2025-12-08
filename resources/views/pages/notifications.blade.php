@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

<div class="max-w-4xl mx-auto pt-10 px-4">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">Notifications</h1>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('status') }}
        </div>
    @endif
    @if($friendRequests->isNotEmpty())

    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        @foreach($friendRequests as $request)
            <div class="p-4 border-b border-gray-100 last:border-b-0 flex items-center justify-between flex-wrap gap-4">
                {{-- User Info --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('profile.show', $request->emitter->id_user) }}">
                        <img src="{{ $request->emitter->getProfileImage() }}" 
                             alt="{{ $request->emitter->name }}" 
                             class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5">
                    </a>
                    <div>
                        <p class="text-sm text-gray-800">
                            <a href="{{ route('profile.show', $request->emitter->id_user) }}" class="font-bold hover:underline">
                                {{ $request->emitter->username }}
                            </a>
                            @if($request->emitter->verifiedUser)
                                <i class="fa-solid fa-circle-check text-blue-500 text-[12px]" title="Verified"></i>
                            @endif
                            <span class="text-gray-600"> wants to be your friend.</span>
                        </p>
                        <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($request->date)->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-2">
                    <form action="{{ route('notifications.accept', $request->id_notification) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-600 hover:bg-greeb-700 text-white text-sm font-semibold py-2 px-4 rounded transition-colors">
                            Accept
                        </button>
                    </form>

                    <form action="{{ route('notifications.deny', $request->id_notification) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-semibold py-2 px-4 rounded transition-colors">
                            Deny
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

@else
    <div class="text-center text-gray-500 mt-10">
        <p>No new notifications</p>
    </div>
@endif
@endsection
