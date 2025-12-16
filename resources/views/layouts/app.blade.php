<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>

    <!-- Styles -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')

    <!-- Scripts -->
    <script src="{{ asset('js/search.js') }}" defer></script>
    <script src="{{ asset('js/home.js') }}" defer></script>
    <script src="{{ asset('js/filter.js') }}" defer></script>
    @stack('scripts')
</head>
<body class="m-0 p-0 min-h-screen overflow-x-hidden bg-white text-gray-800 font-sans">
    {{-- SIDEBAR  --}}
    <aside class="w-64 bg-blue-200 border-r border-gray-200 h-screen fixed top-0 left-0 flex flex-col p-5 z-[1000]">
        <a href="{{ url('/') }}" class="flex items-center no-underline pl-2.5">
            <img src="{{ asset('img/playnation_logo.svg') }}" alt="PlayNation" class="h-[170px]"> 
        </a>
        <nav class="flex flex-col gap-0.5 flex-grow">
            
            <a href="{{ route('home') }}" class="hover:shadow-xl transition-shadow duration-200 flex items-center p-3 text-gray-800 no-underline text-base rounded-lg transition-colors hover:bg-gray-100 {{ request()->is('/') || request()->routeIs('home') ? 'font-bold text-blue-600' : '' }}">
                <i class="fa-solid fa-house w-8 text-xl text-center mr-2.5"></i> 
                Feed
            </a>

            <a href="{{ route('search.users') }}" class="hover:shadow-xl transition-shadow duration-200 flex items-center p-3 text-gray-800 no-underline text-base rounded-lg transition-colors hover:bg-gray-100 {{ request()->routeIs('search.users') ? 'font-bold text-blue-600' : '' }}">
                <i class="fa-solid fa-magnifying-glass w-8 text-xl text-center mr-2.5"></i> 
                Search Users
            </a>

            @if(Auth::check())
                    {{-- auth user zone --}}

                    <a href="{{ route('post.create') }}" class="hover:shadow-xl transition-shadow duration-200 flex items-center p-3 text-gray-800 no-underline text-base rounded-lg transition-colors hover:bg-gray-100 {{ request()->routeIs('post.create') ? 'font-bold text-blue-600' : '' }}">
                        <i class="fa-solid fa-circle-plus w-8 text-xl text-center mr-2.5"></i> 
                        Create Post
                    </a>

                    <a href="{{ route('profile.show', Auth::user()->id_user) }}" class="hover:shadow-xl transition-shadow duration-200 flex items-center p-3 text-gray-800 no-underline text-base rounded-lg transition-colors hover:bg-gray-100 {{ request()->routeIs('profile.show', Auth::user()->id_user) ? 'font-bold text-blue-600' : '' }}">
                        <i class="fa-solid fa-user w-8 text-xl text-center mr-2.5"></i> 
                        My Profile
                    </a>

                    <a href="{{ route('groups.index') }}" class="hover:shadow-xl transition-shadow duration-200 flex items-center p-3 text-gray-800 no-underline text-base rounded-lg transition-colors hover:bg-gray-100 {{ request()->routeIs('groups.index') ? 'font-bold text-blue-600' : '' }}">

                        <i class="fa-solid fa-users w-8 text-xl text-center mr-2.5"></i> 
                        My Groups
                    </a>

                    <a href="{{ route('messages.index') }}" class="hover:shadow-xl transition-shadow duration-200 flex items-center p-3 text-gray-800 no-underline text-base rounded-lg transition-colors hover:bg-gray-100 {{ request()->routeIs('messages.index') ? 'font-bold text-blue-600' : '' }}">
                        <i class="fa-regular fa-comments w-8 text-xl text-center mr-2.5"></i> 
                        Messages
                    </a>

                    <a href="{{ route('notifications.index') }}" class="hover:shadow-xl transition-shadow duration-200 flex items-center p-3 text-gray-800 no-underline text-base rounded-lg transition-colors hover:bg-gray-100 {{ request()->routeIs('notifications.index') ? 'font-bold text-blue-600' : '' }}">
                        <i class="fa-solid fa-bell w-8 text-xl text-center mr-2.5"></i> 
                        Notifications 
                        <span class="bg-red-600 text-white text-xs py-0.5 px-1.5 rounded-full ml-auto">3</span>
                    </a>

                    <a href="{{ route('saved.index') }}" class="hover:shadow-xl transition-shadow duration-200 flex items-center p-3 text-gray-800 no-underline text-base rounded-lg transition-colors hover:bg-gray-100 {{ request()->routeIs('saved.index') ? 'font-bold text-blue-600' : '' }}">
                        <i class="fa-solid fa-bookmark w-8 text-xl text-center mr-2.5"></i>
                        Saved Posts
                    </a>

                    @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin') }}" class="hover:shadow-xl transition-shadow duration-200 flex items-center p-3 text-orange-500 no-underline text-base rounded-lg transition-colors hover:bg-gray-100 {{ request()->routeIs('admin') ? 'font-bold text-blue-600' : '' }}">
                        <i class="fa-solid fa-shield-halved w-8 text-xl text-center mr-2.5"></i>
                        Admin Panel
                    </a>
                    @endif

                    <a href="{{ route('settings.index') }}" class="hover:shadow-xl transition-shadow duration-200 flex items-center p-3 text-gray-800 no-underline text-base rounded-lg transition-colors hover:bg-gray-100 {{ request()->routeIs('settings.index') ? 'font-bold text-blue-600' : '' }}">
                        <i class="fa-solid fa-gear w-8 text-xl text-center mr-2.5"></i> 
                        Settings
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="mt-2.5">
                        @csrf
                        <button type="submit" class="hover:shadow-xl transition-shadow duration-200 flex items-center p-3 bg-transparent border-none w-full text-red-600 cursor-pointer text-base rounded-lg transition-colors hover:bg-gray-100 m-0">
                            <i class="fa-solid fa-arrow-right-from-bracket w-8 text-xl text-center mr-2.5"></i>
                            Log Out
                        </button>
                    </form>

                @else
                    {{-- visitors zone --}}

                    <a href="{{ route('groups.index') }}" class="hover:shadow-xl transition-shadow duration-200 flex items-center p-3 text-gray-800 no-underline text-base rounded-lg transition-colors hover:bg-gray-100 {{ request()->routeIs('groups.index') ? 'font-bold text-blue-600' : '' }}">
                        <i class="fa-solid fa-users w-8 text-xl text-center mr-2.5"></i> 
                        Groups
                    </a>

                    <a href="{{ route('login') }}" class="hover:shadow-xl transition-shadow duration-200 flex items-center p-3 text-gray-800 no-underline text-base rounded-lg transition-colors hover:bg-gray-100 {{ request()->routeIs('login') ? 'font-bold text-blue-600' : '' }}">
                        <i class="fa-solid fa-right-to-bracket w-8 text-xl text-center mr-2.5"></i> 
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="hover:shadow-xl transition-shadow duration-200 flex items-center p-3 text-gray-800 no-underline text-base rounded-lg transition-colors hover:bg-gray-100 {{ request()->routeIs('register') ? 'font-bold text-blue-600' : '' }}">
                        <i class="fa-solid fa-user-plus w-8 text-xl text-center mr-2.5"></i> 
                        Register
                    </a>
                @endif

        </nav>

        <div class="border-t border-gray-400 text-xs text-gray-500 text-center mt-0 pt-2.5">
            <a href="{{ route('about.index') }}" class="hover:shadow-xl transition-shadow duration-200 text-gray-500 no-underline mx-1 hover:underline">About</a> | <a href="#" class="text-gray-500 no-underline mx-1 hover:underline">Help</a>
            <br>
            <p class="mt-2.5">&copy; {{ date('Y') }} PlayNation</p>
        </div>
    </aside>

    {{-- main content --}}
    <main>
        <div id="app-main">
        {{-- toast notification--}}
        @if (session('status'))
            <div id="toast-notification" class="fixed bottom-8 left-72 bg-green-500 text-white py-4 px-5 rounded-lg shadow-xl flex items-center gap-4 min-w-[300px] max-w-[500px] z-[9999] opacity-100 transition-all duration-500 animate-[slideInToast_0.5s_ease-out] md:left-5 md:right-5 md:min-w-0">
                
                {{-- sucess icon --}}
                <i class="fa-solid fa-circle-check text-xl"></i>
                
                {{-- Menssage --}}
                <span class="flex-1">{{ session('status') }}</span>

                {{-- close X --}}
                <button onclick="closeToast()" class="bg-transparent border-none text-white cursor-pointer p-0 m-0 text-lg min-w-0 opacity-80 transition-opacity hover:opacity-100">
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

        <section id="content" class="ml-64 min-h-screen bg-gray-50">
            @yield('content')
        </section>
    </div>
    </main>

</body>
</html>