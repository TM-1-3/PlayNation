@extends('layouts.app')

@section('sidebar')
    @parent

<aside class="sidebar">
        <a href="{{ url('/') }}" class="sidebar-logo">
            <img src="{{ asset('img/playnation_logo.svg') }}" alt="PlayNation">
        </a>

        <nav class="nav-links">
            
            <a href="{{ url('/home') }}" class="nav-item">
                <i class="fa-solid fa-house nav-icon"></i> 
                Feed
            </a>

            @if(Auth::check())
                {{-- auth user zone --}}

                <a href="{{ route('profile.show', Auth::user()->id_user) }}" class="nav-item">
                    <i class="fa-solid fa-user nav-icon"></i> 
                    My Profile
                </a>

                <a href="{{ route('post.create') }}" class="nav-item">
                    <i class="fa-regular fa-square-plus nav-icon"></i> 
                    New Post
                </a>

                <a href="{{ url('/groups') }}" class="nav-item">
                    <i class="fa-solid fa-users nav-icon"></i> 
                    My Groups
                </a>

                <a href="{{ route('messages.index') }}" class="nav-item">
                    <i class="fa-regular fa-comments nav-icon"></i> 
                    Messages
                </a>

                <a href="{{ route('notifications.index') }}" class="nav-item">
                    <i class="fa-solid fa-bell nav-icon"></i> 
                    Notifications 
                    <span style="background:red; color:white; font-size:0.7em; padding:2px 6px; border-radius:50%; margin-left:auto;">3</span>
                </a>

                <a href="{{ route('saved.index') }}" class="nav-item">
                    <i class="fa-solid fa-bookmark nav-icon"></i>
                    Saved Posts
                </a>

                @if(Auth::user()->isAdmin())
                <a href="{{ route('admin') }}" class="nav-item" style="color: #e67e22;">
                    <i class="fa-solid fa-shield-halved nav-icon"></i>
                    Admin Panel
                </a>
                @endif

                <a href="{{ route('settings.index') }}" class="nav-item">
                    <i class="fa-solid fa-gear nav-icon"></i> 
                    Settings
                </a>

                <form action="{{ route('logout') }}" method="POST" style="margin-top: 10px;">
                    @csrf
                    <button type="submit" class="nav-item" style="background:none; border:none; width:100%; color:#e74c3c; cursor:pointer;">
                        <i class="fa-solid fa-arrow-right-from-bracket nav-icon"></i>
                        Log Out
                    </button>
                </form>

            @else
                {{-- visitors zone --}}

                <a href="{{ route('login') }}" class="nav-item">
                    <i class="fa-solid fa-users nav-icon"></i> 
                    Groups
                </a>

                <a href="{{ route('login') }}" class="nav-item">
                    <i class="fa-solid fa-right-to-bracket nav-icon"></i> 
                    Login
                </a>
                <a href="{{ route('register') }}" class="nav-item">
                    <i class="fa-solid fa-user-plus nav-icon"></i> 
                    Register
                </a>
            @endif

        </nav>

        <div class="sidebar-footer">
            <a href="#">About</a> | 
            <a href="#">Contact</a> | 
            <a href="#">Help</a>
            <br>
            <p style="margin-top: 10px;">&copy; {{ date('Y') }} PlayNation</p>
        </div>
</aside>

@endsection