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

        <style>
            body { font-family: sans-serif; margin: 0; padding: 0; background-color: #f4f6f8; }
            header { background-color: #ffffffff; padding: 15px 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
            .logo { font-weight: bold; font-size: 1.5rem; color: #ff4500; text-decoration: none; }
            nav a { text-decoration: none; color: #333; margin-left: 20px; font-weight: 500; }
            nav a:hover { color: #ff4500; }
            main { padding: 30px; min-height: 80vh; } /* Onde o conteúdo entra */
            footer { background-color: #333; color: white; text-align: center; padding: 20px; margin-top: auto; }
            .btn-login { background-color: #ff4500; color: white; padding: 8px 15px; border-radius: 4px; }
        </style>

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
                <a href="{{ url('/') }}">Feed</a>
                <a href="#">Grupos</a>
                
                @if(Auth::check())
                    {{-- if logged in --}}
                    <a href="{{ route('profile.show', Auth::user()->id_user) }}">
                        👤 {{ Auth::user()->username }}
                    </a>
                    
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
            {{-- Se houver mensagens de erro/sucesso --}}
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