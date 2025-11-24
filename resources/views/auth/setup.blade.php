@extends('layouts.app')

@section('title', 'Setup')

<!-- removi estas declrações de doctype e head e metadata porque já temos uma genenralização com o blade no extends(layouts.app) então assim fica tudo mais homogéneo
     adicionei também o rodapé e cabeçalo para ficar consistente sitewide e se se mudar num muda tudo ao mesmo tempo
     mantive as tuas lógicas todas 
     mantive a logica do form
     as rotas apontam para os mesmos controllers
     mantive o csrf
     os inputs também estão iguaisinhos
     e a tua lógica de erros -->

@section('content')

<div class="card setup-container">
    <img class="logo" src = "/img/logo.png">
    <h2>Profile Setup</h2>
    <p style="text-align: center; color: #666; margin-bottom: 20px;">Finish Setting Up Your Profile</p>

    <form method="POST" action="{{ route('profile.setup.store') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="profile_picture">Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
            @error('profile_picture') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="biography">Biography</label>
            <textarea id="biography" name="biography" rows="3" placeholder="I love running and eating pizza..."></textarea>
            @error('biography') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="privacy-toggle">
            <label for="is_public" style="margin:0;">Make Profile Public?</label>
            <input type="checkbox" id="is_public" name="is_public" checked>
        </div>

        <label>Interests (Select all that apply)</label>
        <div class="label-grid">
            @foreach($labels as $label)
                <label class="label-option">
                    <input type="checkbox" name="labels[]" value="{{ $label->id_label }}">
                    
                    <div class="label-card">
                        <img src="{{ asset($label->image) }}" alt="icon">
                        <span>{{ $label->designation }}</span>
                    </div>
                </label>
            @endforeach
        </div>
        
        <button type="submit">Finish Setup</button>
    </form>
</div>

@endsection