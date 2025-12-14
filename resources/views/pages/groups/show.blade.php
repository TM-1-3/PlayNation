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

                {{-- group actions --}}
                <div class="flex flex-col gap-3 mt-6">
                    
                    @auth
                        {{-- Owner? shows edit --}}
                        @if(Auth::id() === $group->id_owner)
                            <a href="{{ route('groups.edit', $group->id_group) }}" class="w-full bg-gray-100 text-gray-700 py-2.5 rounded-lg hover:bg-gray-200 transition font-bold text-center no-underline border border-gray-300">
                                Edit Group Settings
                            </a>
                        
                        {{-- member? shows leave --}}
                        @elseif($group->members->contains(Auth::user()->id_user))
                            <form action="{{ route('groups.leave', $group->id_group) }}" method="POST" onsubmit="return confirm('Are you sure you want to leave this group?');">
                                @csrf
                                <button type="submit" class="w-full bg-white text-red-600 border border-red-200 py-2.5 rounded-lg hover:bg-red-50 transition font-bold shadow-sm">
                                    <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Leave Group
                                </button>
                            </form>

                        {{-- pending join request? shows cancel request --}}
                        @elseif($group->joinRequests->contains(Auth::user()->id_user))
                            <form action="{{ route('groups.cancel_request', $group->id_group) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-yellow-50 text-yellow-700 border border-yellow-200 py-2.5 rounded-lg hover:bg-yellow-100 transition font-bold shadow-sm">
                                    <i class="fa-regular fa-clock mr-2"></i> Request Pending...
                                </button>
                                <p class="text-xs text-center text-gray-400 mt-2 cursor-pointer hover:underline">Click button to cancel</p>
                            </form>

                        {{-- not in n show request to join/join --}}
                        @else
                            <form action="{{ route('groups.join', $group->id_group) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded-lg hover:bg-blue-700 transition font-bold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 duration-200">
                                    {{ $group->is_public ? 'Join Group' : 'Request to Join' }}
                                </button>
                            </form>
                        @endif

                    @else
                        {{-- visitor shows login  --}}
                        <a href="{{ route('login') }}" class="block w-full bg-blue-600 text-white py-5.5 rounded-lg hover:bg-blue-700 transition font-bold text-center no-underline shadow-md">
                            Login to Join
                        </a>
                    @endauth

                </div>
            </div>
        </div>

        {{-- right column chat --}}
        <div class="flex-1 min-w-0">
            
            @if($canViewContent)
                <div class="bg-white rounded-lg shadow-md h-[600px] flex flex-col relative overflow-hidden">
                    
                    {{-- chat header --}}
                    <div class="p-4 border-b bg-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-700">
                            <i class="fa-regular fa-comments mr-2"></i> Group Chat
                        </h3>
                        <span class="text-xs text-gray-500">Live conversation</span>
                    </div>

                    {{-- msgs area --}}
                    <div class="flex-1 p-4 overflow-y-auto bg-gray-50/50" id="chat-messages">
                        <div class="text-center text-gray-400 mt-20">
                            <i class="fa-solid fa-comments text-4xl mb-2"></i>
                            <p>Loading messages...</p>
                        </div>
                    </div>

                    {{-- input part --}}
                    <div class="p-4 border-t bg-white">
                        <form class="flex gap-2">
                            <input type="text" placeholder="Type a message..." class="flex-1 border rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100">
                            <button type="button" class="bg-blue-600 text-white rounded-full w-10 h-10 hover:bg-blue-700 transition flex items-center justify-center">
                                <i class="fa-solid fa-paper-plane text-sm"></i>
                            </button>
                        </form>
                    </div>

                </div>
            @else
                {{-- blockage --}}
                <div class="bg-white rounded-lg shadow-md p-10 text-center border border-gray-200">
                    <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-lock text-4xl text-gray-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Private Group</h2>
                    <p class="text-gray-500 max-w-md mx-auto">
                        This group is private. Join the group to access the chat.
                    </p>
                </div>
            @endif

        </div>

    </div>
</div>

@endsection