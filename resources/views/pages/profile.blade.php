@extends('layouts.app')

@section('title', $user->name)

@section('content')

<div class="max-w-6xl mx-auto pt-10 pr-10 pb-5">

    {{-- unavailable profile --}}
    @if(isset($userUnavailable) && $userUnavailable)
        
        <div class="flex flex-col items-center justify-center min-h-[50vh] text-center fade-in">
            
            {{-- no pfp --}}
            <div class="mb-6 bg-gray-100 p-6 rounded-full shadow-inner">
                <i class="fa-solid fa-user-slash text-5xl text-gray-400"></i>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-2">Profile Unavailable</h1>
            
            <div class="bg-white border border-gray-200 rounded-2xl p-8 max-w-md shadow-lg">
                <p class="text-gray-600 mb-6 leading-relaxed">
                    The content of this profile is not available at the moment. It may have been removed or privacy settings may prevent access.
                </p>

                <a href="{{ route('home') }}" class="block w-full bg-gray-900 text-white px-6 py-3.5 rounded-xl font-bold hover:bg-blue-700 transition transform hover:-translate-y-1 shadow-md flex items-center justify-center gap-2 text-decoration-none">
                    <i class=" fa-solid fa-house"></i> Back to Feed
                </a>
            </div>

        </div>

    {{-- blocked user --}}
    @elseif(isset($isBlockedByMe) && $isBlockedByMe)
        
        <div class="flex flex-col items-center justify-center min-h-[50vh] text-center fade-in">
            
            {{-- foto w blocked effect --}}
            <div class="relative mb-6">
                <img src="{{ $user->getProfileImage() }}" class="w-24 h-24 rounded-full opacity-50 blur-sm grayscale border-4 border-gray-200">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="bg-white rounded-full p-2 shadow-sm">
                        <i class="fa-solid fa-ban text-3xl text-red-500"></i>
                    </div>
                </div>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-1">{{ $user->name }}</h1>
            <h2 class="text-xl text-gray-400 mb-8 font-light">{{ $user->username }}</h2>

            <div class="bg-white border border-gray-200 rounded-2xl p-8 max-w-md shadow-lg">
                <div class="mb-4 text-gray-900">
                    <i class="fa-solid fa-user-slash text-4xl mb-3 text-gray-700"></i>
                    <h3 class="text-xl font-bold">You blocked this user</h3>
                </div>
                
                <p class="text-gray-500 mb-8 leading-relaxed">
                    You have chosen to block interactions with this profile. Content, friends, and details are hidden.
                </p>

                <form action="{{ route('user.block', $user->id_user) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-gray-900 text-white px-6 py-3.5 rounded-xl font-bold hover:bg-gray-800 transition transform hover:-translate-y-1 shadow-md flex items-center justify-center gap-2">
                        <i class="fa-solid fa-unlock"></i> Unblock User
                    </button>
                </form>
            </div>

            <a href="{{ route('home') }}" class="mt-8 text-gray-500 hover:text-blue-600 font-medium transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Back to Feed
            </a>

        </div>

    @else
        {{-- normal profile --}}

        @if($user->isBanned())
            {{-- Banned Account Warning --}}
            <div class="bg-white border border-gray-200 rounded-xl ml-5 px-6 py-5 mb-8 shadow-md">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-50 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-900">Account Suspended</h3>
                        <p class="text-sm text-gray-500 mt-0.5">This account has been restricted from platform activities.</p>
                    </div>
                </div>
            </div>
        @endif

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
                            <a href="{{ route('profile.edit', $user->id_user) }}" class="bg-blue-600 text-white py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center border border-blue-700 transition-colors hover:bg-blue-700" title="Edit your profile">
                                ✏️ Edit Profile
                            </a>

                            {{-- right placeholder button --}} <!-- eddit later but i like a setting ideia -->
                            <button class="bg-transparent text-blue-600 border border-blue-600 py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center transition-colors hover:bg-blue-600 hover:text-white" title="Go to the settings">
                                ⚙️ Settings
                            </button>
                            
                            <form action="{{ route('profile.destroy', $user->id_user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="bg-red-50 text-red-600 border border-red-200 py-2 px-4 rounded font-semibold hover:bg-red-600 hover:text-white transition-colors">
                                    🗑️ Delete My Account
                                </button>
                             </form>
                            
                        @elseif(Auth::check())
                            {{-- others profile --}}
                            
                            {{-- add friend button --}}
                            @if($isFriend)
                                <form action="{{ route('friend.remove', $user->id_user) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this friend?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded inline-flex items-center justify-center cursor-pointer border border-red-700 transition-colors hover:bg-red-700" title="Remove this user as your friend">
                                        Unfriend
                                    </button>
                                </form>
                            @elseif($requestSent)
                            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded inline-flex items-center justify-center cursor-pointer border border-blue-700 transition-colors hover:bg-blue-700" title="Your request to befriend this user is pending">
                                    🕒 Pending Request
                                </button>
                            @else
                                {{-- Add Friend Form --}}
                                <form action="{{ route('user.sendFriendRequest', $user->id_user) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded inline-flex items-center justify-center cursor-pointer border border-blue-700 transition-colors hover:bg-blue-700" title="Send a friend request to this user">
                                        + Add Friend
                                    </button>
                                </form>
                            @endif
                            {{-- msg button --}}
                            @if((!$user->is_public && Auth::id() !== $user->id_user && $isFriend) || ($user->is_public))
                                <a href="{{ route('messages.index', ['start_chat' => $user->id_user]) }}" class="bg-transparent text-blue-600 border border-blue-600 py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center transition-colors hover:bg-blue-600 hover:text-white" title="Send a message to the user">💬 Message</a>
                            @endif
                            @if(Auth::check() && Auth::id() !== $user->id_user)
            
                                <div class="inline-flex items-center gap-2 ml-2">
                                    
                                    {{-- report btn--}}
                                    <button onclick="toggleReport('user', {{ $user->id_user }})" 
                                            class="bg-white text-gray-600 border border-gray-300 py-2 px-4 rounded-lg inline-flex items-center justify-center cursor-pointer transition-colors hover:bg-red-50 hover:text-red-600 hover:border-red-200" 
                                            title="Report this user">
                                        <i class="fa-solid fa-flag mr-2"></i> Report
                                    </button>

                                    @include('partials.report-modal', [
                                        'title' => 'Report User',
                                        'target_type' => 'user',
                                        'target_id' => $user->id_user,
                                    ])

                                    {{-- block btn --}}
                                    <form action="{{ route('user.block', $user->id_user) }}" method="POST" class="m-0" onsubmit="return confirm('Are you sure you want to block this user? You will not see their content anymore.');">
                                        @csrf
                                        
                                        @if(Auth::user()->hasBlocked($user->id_user))
                                            {{-- unblock state --}}
                                            <button type="submit" 
                                                    class="bg-gray-100 text-gray-600 border border-gray-300 py-2 px-4 rounded-lg inline-flex items-center justify-center cursor-pointer transition-colors hover:bg-gray-200" 
                                                    title="Unblock this user">
                                                <i class="fa-solid fa-unlock mr-2"></i> Unblock
                                            </button>
                                        @else
                                            {{-- normal state --}}
                                            <button type="submit" 
                                                    class="bg-white text-gray-600 border border-gray-300 py-2 px-4 rounded-lg inline-flex items-center justify-center cursor-pointer transition-colors hover:bg-gray-800 hover:text-white hover:border-gray-800" 
                                                    title="Block this user">
                                                <i class="fa-solid fa-ban mr-2"></i> Block
                                            </button>
                                        @endif
                                    </form>

                                </div>

                            @endif
                        
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
                        <a href="{{ route('user.friends', $user->id_user) }}" class="block p-2 rounded hover:bg-blue-50 transition-colors" title="Click here to see the friend's list">
                            <h3 class="mb-0 text-blue-600 text-2xl font-bold">
                                {{ $user->friends()->count() }}
                            </h3>
                            <small class="text-gray-600">Friends</small>
                        </a>
                    </div>
                </div>

                {{-- users feed posts --}}
                <h3 class="text-xl font-bold mb-4">Posts</h3>

                @if(!$user->is_public && Auth::id() !== $user->id_user && !$isFriend && !Auth::user()->isAdmin())
                    
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

    @endif

</div>

@endsection