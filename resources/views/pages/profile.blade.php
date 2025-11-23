@extends('layouts.app')

@section('title', $user->name)

@section('content')

{{-- profile principal block --}}
<div class="row">
    {{-- left column photo and data --}}
    <div class="column column-33">
        <div style="text-align: center;">
            <img src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('img/default-user.png') }}" 
                 alt="Profile Picture" 
                 style="border-radius: 50%; width: 200px; height: 200px; object-fit: cover; border: 5px solid #d2afe7;">
            
            <h1>{{ $user->name }}</h1>
            <h4 style="color: gray;">@ {{ $user->username }}</h4>
            
            {{-- Bio --}}
            <p>
                <em>"{{ $user->biography ?? 'This user has no bio yet.' }}"</em>
            </p>

            
            <div class="actions" style="margin-top: 20px;">
                
                @if(Auth::check() && Auth::id() == $user->id_user)
                    {{-- My profile --}}
                    <a href="{{ route('profile.edit', $user->id_user) }}" class="button">
                        ✏️ Edit Profile
                    </a>
                    
                @elseif(Auth::check())
                    {{-- others profile --}}
                    
                    {{-- add friend button --}}
                    <button class="button"> + add fiend </button>
                    
                    {{-- msg button --}}
                    <a href="#" class="button button-outline">💬 Message</a>
                
                @else
                    {{-- not logged in--}}
                    <p><small>Login to add your athlete profile</small></p>
                @endif

            </div>
        </div>
    </div>

    {{-- stats and personal posts feed --}}
    <div class="column column-67">
        
        {{-- stats --}}
        <div class="row" style="margin-bottom: 2em; border-bottom: 1px solid #eee; padding-bottom: 1em;">
            <div class="column" style="text-align: center;">
                <h3>0</h3>
                <small>Posts</small>
            </div>
            <div class="column" style="text-align: center;">
                <h3>0</h3>
                <small>Followers</small>
            </div>
            <div class="column" style="text-align: center;">
                <h3>0</h3>
                <small>Following</small>
            </div>
        </div>

        {{-- users feed posts --}}
        <h3>Publicações Recentes</h3>
        
        {{-- posts loop for later --}}
        <div class="card">
            <p>No posts yet.</p>
        </div>

    </div>
</div>

@endsection