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
                class="w-[150px] h-[150px] rounded-full object-cover border-4 border-blue-900 block mx-auto mb-4 shadow-md">
            
            <h1 class="mb-1 text-2xl font-bold">{{ $user->name }}</h1>
            <h4 class="text-gray-500 font-normal mb-6 text-lg">{{ $user->username }}</h4>
            
            {{-- Bio --}}
            <p class="italic text-gray-600 mb-6">
                "{{ $user->biography ?? 'This user has no bio yet.' }}"
            </p>

            
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
                    <button class="bg-blue-600 text-white py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center border border-blue-700 transition-colors hover:bg-blue-700"> + add fiend </button>
                    
                    {{-- msg button --}}
                    <a href="#" class="bg-transparent text-blue-600 border border-blue-600 py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center transition-colors hover:bg-blue-600 hover:text-white">💬 Message</a>
                
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
            <div class="text-center">
                <h3 class="mb-0 text-blue-600 text-2xl font-bold">{{ $user->followers_count ?? 0 }}</h3>
                <small class="text-gray-600">Followers</small>
            </div>
            <div class="text-center">
                <h3 class="mb-0 text-blue-600 text-2xl font-bold">{{ $user->following_count ?? 0 }}</h3>
                <small class="text-gray-600">Following</small>
            </div>
        </div>

        {{-- users feed posts --}}
        <h3 class="text-xl font-bold mb-4">Posts</h3>
        
        @if($posts->isEmpty())
            <div class="rounded-lg shadow-sm p-8 mb-8 text-center text-gray-500">
                <p>No posts yet.</p>
            </div>
        @else
            @foreach($posts as $post)
                    @include('partials.post', ['post' => $post, 'type' => 'profile'])
            @endforeach
        @endif

    </div>
</div>
</div>

@endsection