@extends('layouts.app')

@section('title', $group->name)

@section('content')

<div class="row">
    {{-- Grupo Info --}}
    <div class="column column-33 profile-sidebar"> <img src="{{ $group->picture ? asset($group->picture) : asset('img/default-group.png') }}" 
             alt="{{ $group->name }}" 
             style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 20px; border: 1px solid #ddd;">
        
        <h2 style="margin-bottom: 5px;">{{ $group->name }}</h2>
        
        <div style="margin-bottom: 20px;">
            @if($group->is_public)
                <span class="button button-outline button-small" style="pointer-events: none; padding: 0 10px; height: 25px; line-height: 25px; font-size: 0.7em;">🌎 Public</span>
            @else
                <span class="button button-small" style="background: #666; border-color: #666; pointer-events: none; padding: 0 10px; height: 25px; line-height: 25px; font-size: 0.7em;">🔒 Private</span>
            @endif
        </div>

        <p><em>{{ $group->description ?? 'No description.' }}</em></p>

        <div class="profile-actions" style="flex-direction: column; gap: 10px;">
            
            {{-- Owner actions or admin --}}
            @if(Auth::check() && (Auth::id() === $group->id_owner || Auth::user()->isAdmin()))
                <a href="{{ route('groups.edit', $group->id_group) }}" class="button" style="width: 100%;">⚙️ Edit Group</a>
            @endif

            {{-- Placeholder para Join/Leave (Próxima Missão) --}}
            <button class="button button-outline" style="width: 100%;">Join Group</button>

        </div>
    </div>

    {{-- Group feed --}}
    <div class="column column-67">
        <h3>Group Feed</h3>
        <div class="card empty-state">
            <p>No posts in this group yet.</p>
        </div>
    </div>
</div>

@endsection