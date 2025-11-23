@extends('layouts.app')

@section('title', 'Login')

<!-- removi estas declrações de doctype e head e metadata porque já temos uma genenralização com o blade no extends(layouts.app) então assim fica tudo mais homogéneo
     adicionei também o rodapé e cabeçalo para ficar consistente sitewide e se se mudar num muda tudo ao mesmo tempo
     mantive as tuas lógicas todas 
     mantive a logica do form
     as rotas apontam para os mesmos controllers
     mantive o csrf
     os inputs também estão iguaisinhos
     e a tua lógica de erros -->

@section('content')

<div class="row">
    {{-- center card --}}
    <div class="column column-50 column-offset-25; justify-content:center;">
        
        <div class="card" style="margin-top: 2em; padding: 2em;">
            <h2 style="text-align: center; color: #9b4dca;">Login</h2>

            <!-- mantive a logica do form e csrf -->
            <form method="POST" action="{{ route('login.action') }}">
                @csrf

                <div>
                    <label for="login">Email or Username</label>
                    <input type="text" id="login" name="usernameEmail" required autofocus value="{{ old('login') }}">
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <!-- mantive a logica dos erros mas mudei um cadinho o style -->
                @if ($errors->any())
                    <div class="error" style="color: red; font-weight: bold; margin-bottom: 1em;">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <button type="submit" class="button button-block" style="width: 100%;">Log in</button>
            </form>

            <!-- mantive os links de relação ao register originais -->
            <div style="text-align: center; margin-top: 15px;">
                <a href="{{ route('register') }}" style="color: #9b4dca;">
                    Don't have an account? Register
                </a>
                <br>
                <a href="{{ route('home') }}" class="link" style="color: #6b7280; font-size: 0.9em; display: inline-block; margin-top: 10px;">
                    Continue without logging in
                </a>
            </div>
        </div>

    </div>
</div>

@endsection
