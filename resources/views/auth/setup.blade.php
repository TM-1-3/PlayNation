@extends('layouts.app')

@section('title', 'Profile Setup')

{{-- Carregar CSS específico desta página (se precisares do setup.css) --}}
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/setup.css') }}">
@endpush

@section('content')

<div class="centered-content">
    <div class="card setup-container" style="max-width: 600px; padding: 2em; text-align: left; margin-top: 2em;">
        
        {{-- Cabeçalho --}}
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ asset('img/logo.png') }}" style="height: 60px; margin-bottom: 10px;">
            <h2 style="color: #1e00ff;">Profile Setup</h2>
            <p style="color: #666;">Finish setting up your profile to join the community.</p>
        </div>

        <form method="POST" action="{{ route('profile.setup.store') }}" enctype="multipart/form-data">
            @csrf

            <label for="profile_picture">Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
            @error('profile_picture') <span style="color: red; font-size: 0.8em;">{{ $message }}</span> @enderror

            <label for="biography">Biography</label>
            <textarea id="biography" name="biography" rows="3" placeholder="I love running and eating pizza..." style="width: 100%;"></textarea>
            @error('biography') <span style="color: red; font-size: 0.8em;">{{ $message }}</span> @enderror

            <div class="privacy-toggle" style="margin: 20px 0; display: flex; align-items: center;">
                <input type="checkbox" id="is_public" name="is_public" checked style="margin-right: 10px;">
                <label for="is_public" style="margin: 0;">Make Profile Public?</label>
            </div>

            <hr>

            <label>Interests (Select all that apply)</label>
            <div class="label-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 10px;">
                @foreach($labels as $label)
                    <label class="label-option" style="cursor: pointer; border: 1px solid #ddd; padding: 10px; border-radius: 8px; text-align: center; display: block;">
                        <input type="checkbox" name="labels[]" value="{{ $label->id_label }}" style="margin-bottom: 5px;">
                        
                        <div class="label-card">
                            {{-- Se tiveres ícones para as labels, usa asset() --}}
                            {{-- <img src="{{ asset($label->image) }}" alt="icon" style="width: 30px;"> --}}
                            <span style="display: block; font-size: 0.9em; font-weight: bold;">{{ $label->designation }}</span>
                        </div>
                    </label>
                @endforeach
            </div>
            
            <button type="submit" class="button button-block" style="width: 100%; margin-top: 20px;">Finish Setup 🚀</button>
        </form>
    </div>
</div>

@endsection