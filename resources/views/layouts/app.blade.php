<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/milligram.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">


        @stack('styles')

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @stack('scripts')
    </head>
    <body>
        {{-- 1. Header --}}
        <header>
            <a href="{{ url('/') }}" class="logo">PlayNation 🏀</a>

            <nav>
                <a href="{{ route('home') }}">Feed</a>
                @if(Auth::check())
                    {{-- if logged in --}} <!-- add later -->
                    <a href="{{ route('groups') }}">Groups</a>
                @else
                    {{-- if visitor --}} <!-- send to login-->
                    <a href="{{ route('login') }}">Groups</a>
                @endif
                
                @if(Auth::check())
                    {{-- if logged in --}}
                    <a href="{{ route('profile.show', Auth::user()->id_user) }}">
                        👤 {{ Auth::user()->username }}
                    </a>

                    {{-- i'll add constraint so that only admin's can view thi button--}}
                    {{--@if (auth()->check() && auth()->user()->isAdmin())--}}
                    <a href="{{ route('admin') }}">Admin</a>
                    
                    {{-- Logout form ( POST for securty) --}}
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; cursor: pointer; color: #333; font-weight: 500; margin-left: 20px;">
                            Log Out 🚪
                        </button>
                    </form>
                @else
                    {{-- if visitor --}}
                    <a href="{{ route('login') }}" class="btn-login">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endif
    
            </nav>
            
        </header>
        
        {{-- 2. Main Content --}}
        <main>
            {{-- error/sucess messages --}}
            @if (session('status'))
                <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                    {{ session('status') }}
                </div>
            @endif

            @yield('content')  
        </main>

        {{-- 3. Footer --}}
        <footer>
            <p>&copy; 2024 PlayNation - LBAW Project</p>
        </footer>

    </body>
</html>