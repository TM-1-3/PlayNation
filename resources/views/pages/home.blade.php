<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ time() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="{{ asset('js/home.js') }}?v={{ time() }}" defer></script>
</head>
<body>
<div class="app-layout">
    @include('layouts.sidebar')
    <main class="main-content">
        <div class="content-wrapper">
            @auth
            <div class="feed-toggle-container">
            <a href="{{ route('home', ['timeline' => 'public']) }}" class="feed-tab @if (isset($activeTimeline) && $activeTimeline === 'public') active @endif"> Recent</a>
            <a href="{{ route('home', ['timeline' => 'personalized']) }}" class="feed-tab @if(isset($activeTimeline) && $activeTimeline === 'personalized') active @endif">For You</a>
            </div>
            @endauth
            <div class="timeline">
                @if(isset($posts) && $posts->isEmpty())
                    <div class="no-posts">
                        <p>No posts found.</p>
                        @if(isset($activeFeed) && $activeFeed === 'personalized')
                            <p style="font-size: 0.9rem; margin-top: 5px;">Try adding more interests to your profile!</p>
                        @endif
                    </div>
                @elseif(isset($posts))
                    @foreach($posts as $post)
                        <div class="post" id="post-{{ $post->id_post }}">
                            <div class="post-header">
                                @if($post->user)
                                    <a href="{{ route('profile.show', $post->user->id_user) }}">
                                        <img class="author" 
                                             src="@if($post->user->profile_picture) {{ asset($post->user->profile_picture) }} @else {{ asset('img/default_avatar.png') }} @endif" 
                                             alt="avatar">
                                    </a>
                                    <a href="{{ route('profile.show', $post->user->id_user) }}" class="username">
                                        {{ $post->user->username }}
                                    </a>
                                @else
                                    <img class="author" src="{{ asset('img/default_avatar.png') }}" alt="avatar">
                                    <span class="username">Unknown User</span>
                                @endif
                                
                                <span class="post-time">{{ \Carbon\Carbon::parse($post->date)->diffForHumans() }}</span>

                                @if(Auth::check() && $post->user && Auth::user()->id_user == $post->user->id_user)
                                    <button class="button-delete" data-id="{{ $post->id_post }}" title="Delete Post">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                @endif

                            </div>

                            @if($post->image)
                                <img class="post-image" src="{{ asset($post->image) }}" alt="Post Content">
                            @endif
                            <div class="caption">
                                @if($post->user)
                                    <a href="{{ route('profile.show', $post->user->id_user) }}" class="caption-user">
                                        {{ $post->user->username }}
                                    </a>
                                @endif
                                {{ $post->description }}
                            </div>

                            @if($post->labels->isNotEmpty())
                                <div class="post-tags">
                                    @foreach($post->labels as $label)
                                        <span class="tag">{{ $label->designation }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div> 
                    @endforeach
                @endif
            </div> 
        </div> 
    </main>

</div>
</body>
</html>