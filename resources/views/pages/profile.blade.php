@extends('layouts.app')

@section('title', $user->name)

@section('content')

{{-- profile principal block --}}
<div class="max-w-6xl mx-auto pt-10 pr-10 pb-5">
<div class="flex flex-wrap gap-8">
    {{-- left column photo and data --}}
    <div class="w-full md:w-1/3 md:min-w-[250px] text-center">

            <img src="{{ $user->getProfileImage() }}" 
                alt="{{ $user->name }}" 
                class="w-[150px] h-[150px] rounded-full object-cover block mx-auto mb-4 shadow-md">
            
            <h1 class="mb-1 text-2xl font-bold">
                {{ $user->name }}
            </h1>
            <h4 class="text-gray-500 font-normal mb-6 text-lg">
                {{ $user->username }}
                @if($user->verifiedUser)
                    <i class="fa-solid fa-circle-check text-blue-500 text-lg" title="Verified Account"></i>
                @endif
            </h4>
            
            {{-- Bio --}}
            <p class="italic text-gray-600 mb-6">
                "{{ $user->biography ?? 'This user has no bio yet.' }}"
            </p>
            @if($user->labels->isNotEmpty())
                <div class="flex flex-wrap justify-center gap-2 mb-6">
                    @foreach($user->labels as $label)
                        <span class="bg-blue-50 text-blue-700 text-xs font-medium px-2.5 py-0.5 rounded border border-blue-200">
                            {{ $label->designation }}
                        </span>
                    @endforeach
                </div>
            @endif

            
            <div class="mt-5 flex justify-center items-center gap-4 flex-wrap">
                
                @if(Auth::check() && Auth::id() == $user->id_user)
                    {{-- My profile --}}

                    {{-- left edit profile button --}}
                    <a href="{{ route('profile.edit', $user->id_user) }}" class="bg-blue-600 text-white py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center border border-blue-700 transition-colors hover:bg-blue-700">
                        ✏️ Edit Profile
                    </a>

                    {{-- right placeholder button --}} <!-- eddit later but i like a setting ideia -->
                    <button class="bg-transparent text-blue-600 border border-blue-600 py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center transition-colors hover:bg-blue-600 hover:text-white" title="Feature para breve">
                        ⚙️ Settings
                    </button>                    
                    
                @elseif(Auth::check())
                    {{-- others profile --}}
                    
                    {{-- add friend button --}}
                    @if($isFriend)
                        <form action="{{ route('friend.remove', $user->id_user) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this friend?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded inline-flex items-center justify-center cursor-pointer border border-red-700 transition-colors hover:bg-red-700">
                                Unfriend
                            </button>
                        </form>
                    @elseif($requestSent)
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded inline-flex items-center justify-center cursor-pointer border border-blue-700 transition-colors hover:bg-blue-700">
                            🕒 Pending Request
                        </button>
                    @else
                        {{-- Add Friend Form --}}
                        <form action="{{ route('user.sendFriendRequest', $user->id_user) }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded inline-flex items-center justify-center cursor-pointer border border-blue-700 transition-colors hover:bg-blue-700">
                                + Add Friend
                            </button>
                        </form>
                        @endif
                    {{-- msg button --}}
                    <a href="#" class="bg-transparent text-blue-600 border border-blue-600 py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center transition-colors hover:bg-blue-600 hover:text-white">💬 Message</a>

                    <button onclick="toggleReport('user', {{ $user->id_user }})" class="bg-transparent text-red-600 border border-red-200 py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center transition-colors hover:bg-red-50 ml-2">🚩 Report</button>

                    @include('partials.report_modal', [
                        'modalId' => "report-modal-user-{$user->id_user}",
                        'action' => route('report.submit'),
                        'title' => 'Report User',
                        'target_type' => 'user',
                        'target_id' => $user->id_user,
                    ])
                
                @else
                    {{-- not logged in--}}
                    <a href="{{ route('login') }}" class="bg-transparent text-blue-600 border border-blue-600 py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center transition-colors hover:bg-blue-600 hover:text-white">Login to start interacting</a>
                @endif

            </div>
        
    </div>

    {{-- right cloumn stats and personal posts feed --}}
    <div class="flex-1 min-w-0">
        
        {{-- stats --}}
        <div class="flex justify-around mb-8 border-b border-gray-200 pb-4">
            <div class="text-center">
                <h3 class="mb-0 text-blue-600 text-2xl font-bold">{{ $user->posts_count ?? $posts->count() }}</h3>
                <small class="text-gray-600">Posts</small>
            </div>
            <div class="text-center group">
                <a href="{{ route('user.friends', $user->id_user) }}" class="block p-2 rounded hover:bg-blue-50 transition-colors">
                    <h3 class="mb-0 text-blue-600 text-2xl font-bold">
                        {{ $user->friends()->count() }}
                    </h3>
                    <small class="text-gray-600">Friends</small>
                </a>
            </div>
        </div>

        {{-- users feed posts --}}
        <h3 class="text-xl font-bold mb-4">Posts</h3>

        @if(!$user->is_public && Auth::id() !== $user->id_user && !$isFriend)
            
            <div class="rounded-lg shadow-sm p-8 mb-8 text-center text-gray-500">
                <h2 class="text-lg font-bold text-gray-800 mb-2">This account is private</h2>
                <p class="text-gray-500 text-sm">Add this user as a friend to see their posts</p>
            </div>
        @else
        
        @if($posts->isEmpty())
            <div class="rounded-lg shadow-sm p-8 mb-8 text-center text-gray-500">
                <p>No posts yet</p>
            </div>
        @else
            @foreach($posts as $post)
                    @include('partials.post', ['post' => $post, 'type' => 'profile'])
            @endforeach
        @endif
        @endif

    </div>
</div>
</div>

@endsection