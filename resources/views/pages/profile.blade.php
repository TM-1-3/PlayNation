@extends('layouts.app')

@section('title', $user->name)

@section('content')

{{-- profile principal block --}}
<div class="row">
    {{-- left column photo and data --}}
    <div class="column column-33 profile-sidebar">

            <img src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('img/default-user.png') }}" 
                alt="{{ $user->name }}" 
                class="profile-avatar">
            
            <h1 class="profile-name">{{ $user->name }}</h1>
            <h4 class="profile-username">@ {{ $user->username }}</h4>
            
            {{-- Bio --}}
            <p>
                <em>"{{ $user->biography ?? 'This user has no bio yet.' }}"</em>
            </p>

            
            <div class="profile-actions">
                
                @if(Auth::check() && Auth::id() == $user->id_user)
                    {{-- My profile --}}

                    {{-- left edit profile button --}}
                    <a href="{{ route('profile.edit', $user->id_user) }}" class="button">
                        ✏️ Edit Profile
                    </a>

                    {{-- right placeholder button --}} <!-- eddit later but i like a setting ideia -->
                    <button class="button button-outline" title="Feature para breve">
                        ⚙️ Settings
                    </button>                    
                    
                @elseif(Auth::check())
                    {{-- others profile --}}
                    
                    {{-- add friend button --}}
                    <button class="button"> + add fiend </button>
                    
                    {{-- msg button --}}
                    <a href="#" class="button button-outline">💬 Message</a>
                
                @else
                    {{-- not logged in--}}
                    <a href="{{ route('login') }}" class="button button-outline">Login to start interacting</a>
                @endif

            </div>
        
    </div>

    {{-- right cloumn stats and personal posts feed --}}
    <div class="column column-67">
        
        {{-- stats --}}
        <div class="row profile-stats">
            <div class="column stat-item">
                <h3>0</h3>
                <small>Posts</small>
            </div>
            <div class="column stat-item">
                <h3>0</h3>
                <small>Followers</small>
            </div>
            <div class="column stat-item">
                <h3>0</h3>
                <small>Following</small>
            </div>
        </div>

        {{-- users feed posts --}}
        <h3>Recent Posts</h3>
        
        {{-- posts loop for later --}}
        <div class="card empty-state">
            <p>No posts yet.</p>
        </div>

    </div>
</div>

@endsection