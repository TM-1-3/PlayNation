<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <div class ="header-section">

    @auth
        <h1>You are logged in</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Log out</button>
        </form>
    @endauth

    @guest
        <h1>You are a visitor</h1>
        <a href="{{ route('login') }}">
            <button>Log in</button>
        </a>
    @endguest
    </div>

    @auth
    <div class="feed-toggle">
        <a href="{{ route('home', ['feed' => 'public']) }}" class="feed-tab @if (isset($activeFeed) && $activeFeed === 'public') active @endif"> Recent</a>
        <a href="{{ route('home', ['feed' => 'personalized']) }}" class="feed-tab @if(isset($activeFeed) && $activeFeed === 'personalized') active @endif">For You</a>
    </div>
    @endauth

    <div class="timeline">
        @foreach($posts as $post)
        <div class="post">
        <img class="author" src="@if ($post->user->profile_picture) {{ asset($post->user->profile_picture) }} @else {{ asset('img/default_avatar.png') }} @endif" alt="avatar">
        <span class="username">{{ $post->user->username }}</span>
        <span class="post-time">{{ \Carbon\Carbon::parse($post->date)->diffForHumans() }}</span>
        @if($post->image)
            <img class="post-image" src="{{ asset($post->image) }}" alt="Post Content">
        @endif
        <div class="caption">
            <span class="caption-user">{{ $post->user->username }}</span>
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
</div>

</body>
</html>