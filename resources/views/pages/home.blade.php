@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<div class="max-w-3xl mx-auto p-5">
    @auth
    <div class="flex justify-between items-center mb-5">
        <div>
            <a href="{{ route('home', ['timeline' => 'public']) }}" class="flex-1 text-center py-3 no-underline text-gray-500 font-semibold text-sm border-b-2 max-w-[200px] transition-colors {{ (isset($activeTimeline) && $activeTimeline === 'public') ? 'text-gray-800 border-gray-800' : 'border-transparent' }}"> Recent</a>
            <a href="{{ route('home', ['timeline' => 'personalized']) }}" class="flex-1 text-center py-3 no-underline text-gray-500 font-semibold text-sm border-b-2 max-w-[200px] transition-colors {{ (isset($activeTimeline) && $activeTimeline === 'personalized') ? 'text-gray-800 border-gray-800' : 'border-transparent' }}">For You</a>
        </div>

        {{-- fixed Following button --}}
        <div>
            <a href="{{ route('home', ['timeline' => 'following']) }}" class="bg-blue-600 border border-blue-700 text-white py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center hover:bg-blue-800 whitespace-nowrap">Friend's Posts</a>
        </div>
    </div>
    @endauth
    <div class="my-5">
        <form id="search-home" action="{{ route('search.posts') }}" method="GET">
            <input type="text" id="search-input-home" name="search" placeholder="Search for posts by username, tags or description..." class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
        </form>
    </div>
    <div id="timeline" class="w-full pb-12">
            @if(isset($posts) && $posts->isEmpty())
                <div class="text-center py-10 text-gray-500">
                    <p>No posts found.</p>
                    @if(isset($activeFeed) && $activeFeed === 'personalized')
                        <p class="text-sm mt-1">Try adding more interests to your profile!</p>
                    @endif
                </div>
            @elseif(isset($posts))
                @foreach($posts as $post)
                    <div class="bg-white border border-gray-200 rounded-lg mb-5 text-left flex flex-col" id="post-{{ $post->id_post }}">
                        <div class="flex items-center p-3.5">
                            @if($post->user)
                                <a href="{{ route('profile.show', $post->user->id_user) }}">
                                    <img class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5" 
                                         src="@if($post->user->profile_picture) {{ asset($post->user->profile_picture) }} @else {{ asset('img/default_avatar.png') }} @endif" 
                                         alt="avatar">
                                </a>
                                <a href="{{ route('profile.show', $post->user->id_user) }}" class="font-semibold text-sm text-gray-800 no-underline">
                                    {{ $post->user->username }}
                                </a>
                            @else
                                <img class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5" src="{{ asset('img/default_avatar.png') }}" alt="avatar">
                                <span class="font-semibold text-sm text-gray-800">Unknown User</span>
                            @endif
                            
                            <span class="ml-auto text-xs text-gray-500">{{ \Carbon\Carbon::parse($post->date)->diffForHumans() }}</span>


                        </div>

                        @if($post->image)
                            <img class="w-full block border-t border-gray-200" src="{{ asset($post->image) }}" alt="Post Content">
                        @endif
                        <div class="py-3 px-4 text-sm leading-relaxed">
                            @if($post->user)
                                <a href="{{ route('profile.show', $post->user->id_user) }}" class="font-semibold mr-1 text-gray-800 no-underline">
                                    {{ $post->user->username }}
                                </a>
                            @endif
                            {{ $post->description }}
                        </div>

                        @if($post->labels->isNotEmpty())
                            <div class="px-4 pb-4 flex gap-1 flex-wrap">
                                @foreach($post->labels as $label)
                                    <span class="bg-blue-500 text-white text-xs py-1 px-2 rounded font-semibold">{{ $label->designation }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div> 
                @endforeach
            @endif
        </div>
</div>