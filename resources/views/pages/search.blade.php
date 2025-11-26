@extends('layouts.app')

@section('title', 'Search Page')

@section('content')

<div id="search-user">
    <form id="search-user" action="{{ route('search.users') }}" method="GET">
        <input type="text" id="search-input-user" name="search" placeholder="Search by Name, Username or Email...">
        <button class="btn-primary" type="submit" style="background-color: #3498db;">Search</button>
    </form>
    @foreach($users as $user)
    <div class="user-search">
        <a href="{{ route('profile.show',$user->id_user) }}" class="search-name">{{ $user->name }}</a>
        <a href="{{ route('profile.show',$user->id_user) }}" class="search-username">{{ $user->username }}</a>
    </div>
    @endforeach
</div>

@endsection