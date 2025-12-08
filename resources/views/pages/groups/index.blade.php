@extends('layouts.app')

@section('title', 'Groups')

@section('content')

<div class="row">
    <div class="column">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="margin:0; color: #1e00ff;">Groups</h2>
            
            {{-- create btn only auth --}}
            @auth
                <a href="{{ route('groups.create') }}" class="button">
                    <i class="fa-solid fa-plus"></i> Create Group
                </a>
            @endauth
        </div>

        {{-- search bar --}}
        <form action="{{ route('groups.index') }}" method="GET" style="margin-bottom: 30px;">
            <div style="display: flex; gap: 10px;">
                <input type="text" name="search" placeholder="Find a group..." value="{{ request('search') }}" style="margin: 0;">
                <button type="submit" class="button button-outline">Search</button>
            </div>
        </form>

        {{-- groups  --}}
        <div id="cards"> @forelse($groups as $group)
                <article class="card">
                    {{-- img --}}
                    <img src="{{ $group->picture ? asset($group->picture) : asset('img/default-group.png') }}" 
                         alt="{{ $group->name }}" 
                         style="width: 100%; height: 150px; object-fit: cover; border-radius: 4px 4px 0 0; margin-bottom: 10px;">
                    
                    <header style="padding: 0 10px;">
                        <h3 style="font-size: 1.2rem; margin: 0;">
                            <a href="{{ route('groups.show', $group->id_group) }}" style="color: #333; text-decoration: none;">
                                {{ $group->name }}
                            </a>
                        </h3>
                    </header>
                    
                    <div style="padding: 10px; font-size: 0.9rem; color: #666; flex: 1;">
                        <p>{{ Str::limit($group->description, 60) }}</p>
                    </div>

                    <footer style="padding: 10px; margin-top: auto;">
                        <a href="{{ route('groups.show', $group->id_group) }}" class="button button-outline" style="width: 100%;">View Group</a>
                    </footer>
                </article>
            @empty
                <div class="column" style="text-align: center; padding: 40px; color: gray;">
                    <i class="fa-solid fa-users-slash" style="font-size: 3em; margin-bottom: 10px;"></i>
                    <p>No groups found.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection