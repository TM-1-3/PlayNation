@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<div class="max-w-3xl mx-auto p-5">
    @auth
    <div>
        <div class="flex gap-4 justify-around items-center mb-5">
            <a href="{{ route('home', ['timeline' => 'public']) }}" class="flex-1 text-center py-3 no-underline text-gray-500 font-semibold text-sm border-b-2 max-w-[200px] transition-colors {{ (isset($activeTimeline) && $activeTimeline === 'public') ? 'text-gray-800 border-gray-800' : 'border-transparent' }}"> Recent</a>
            <a href="{{ route('home', ['timeline' => 'personalized']) }}" class="flex-1 text-center py-3 no-underline text-gray-500 font-semibold text-sm border-b-2 max-w-[200px] transition-colors {{ (isset($activeTimeline) && $activeTimeline === 'personalized') ? 'text-gray-800 border-gray-800' : 'border-transparent' }}">For You</a>
            <a href="{{ route('home', ['timeline' => 'following']) }}" class="flex-1 text-center py-3 no-underline text-gray-500 font-semibold text-sm max-w-[200px] transition-colors">Friends</a>
        </div>
    </div>
    @endauth
    <div class="mb-5 mx-auto">
        <form  id="search-home" action="{{ route('search.posts') }}" method="GET" class="relative">
                            
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
                                
            <input id="search-input-home" type="text" name="search" placeholder="Search for posts by username, tags or description.." 
                    class="h-[2em] block w-full pl-10 pr-24 py-3 border-none rounded-lg shadow-md text-gray-900  bg-white outline-none">        
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
                    @include('partials.post', ['post' => $post, 'type' => 'home'])
                @endforeach
            @endif
        </div>
</div>
</div>
@endsection