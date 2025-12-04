@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<div class="max-w-3xl mx-auto p-5">
    @auth
    <div>
        <div class="flex gap-4 justify-around items-center mb-5">
            <a href="{{ route('home', ['timeline' => 'public']) }}" class="flex-1 text-center py-3 no-underline text-gray-500 font-semibold text-sm border-b-2 max-w-[200px] transition-colors {{ (isset($activeTimeline) && $activeTimeline === 'public') ? 'text-gray-800 border-gray-800' : 'border-transparent' }}"> Recent</a>
            <a href="{{ route('home', ['timeline' => 'personalized']) }}" class="flex-1 text-center py-3 no-underline text-gray-500 font-semibold text-sm border-b-2 max-w-[200px] transition-colors {{ (isset($activeTimeline) && $activeTimeline === 'personalized') ? 'text-gray-800 border-gray-800' : 'border-transparent' }}">For You</a>
            <!-- <a href="{{ route('home', ['timeline' => 'following']) }}" class="flex-1 text-center py-3 no-underline text-gray-500 font-semibold text-sm max-w-[200px] transition-colors">Friend's Posts</a> -->
        </div>
    </div>
    @endauth
    <div class="my-5">
        <form id="search-home" action="{{ route('search.posts') }}" method="GET">
            <input type="text" id="search-input-home" name="search" placeholder="Search for posts by username, tags or description..." class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none h-[2em]">
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