<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/milligram.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/setup.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/home.js') }}?v={{ time() }}" defer></script>
    <script src="{{ asset('js/admin.js') }}" defer></script>
    @stack('scripts')

</head>
<body>
    {{-- SIDEBAR  --}}
    <aside class="sidebar">
        <a href="{{ url('/') }}" class="sidebar-logo">
            <img src="{{ asset('img/playnation_logo.svg') }}" alt="PlayNation" style="height: 170px;"> 
        </a>
        <nav class="nav-links">
            
            <a href="{{ url('/home') }}" class="nav-item {{ request()->is('/') || request()->routeIs('home') ? 'active' : '' }}">
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
                        <button type="submit" class="nav-item" style="background:none; border:none; width:100%; color:#e74c3c; cursor:pointer; font-size:0.7em; margin:0;">
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
            <a href="#">About</a> | <a href="#">Help</a>
            <br>
            <p style="margin-top: 10px;">&copy; {{ date('Y') }} PlayNation</p>
        </div>
    </aside>

    {{-- main content --}}
    <main>
        <div id="app-main">
        {{-- toast notification--}}
        @if (session('status'))
            <div id="toast-notification" class="toast-success">
                
                {{-- sucess icon --}}
                <i class="fa-solid fa-circle-check" style="font-size: 1.2em;"></i>
                
                {{-- Menssage --}}
                <span style="flex: 1;">{{ session('status') }}</span>

                {{-- close X --}}
                <button onclick="closeToast()" class="toast-close-btn">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            {{-- disapear --}}
            <script>
                // waits for page to load
                document.addEventListener('DOMContentLoaded', function() {
                    const toast = document.getElementById('toast-notification');
                    
                    if (toast) {
                        // takes 10 sec (10000 ms)
                        setTimeout(function() {
                            closeToast();
                        }, 10000);
                    }
                });

                function closeToast() {
                    const toast = document.getElementById('toast-notification');
                    if (toast) {
                        
                        toast.style.opacity = '0';
                        toast.style.transform = 'translateY(20px)';
                        
                        // remove after animation (0.5s)
                        setTimeout(() => toast.remove(), 500);
                    }
                }
            </script>
        @endif

        <section id="content">
            @yield('content')
        </section>
    </div>
    </main>

</body>
</html>