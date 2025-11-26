@extends('layouts.app')

@section('title', 'Search Page')

@section('content')

<div id="search-user">
    @foreach($users as $user)
    <div class="user-search">
        <a href="{{ route('profile.show',$user->id_user) }}" class="search-name">{{ $user->name }}</a>
        <a href="{{ route('profile.show',$user->id_user) }}" class="search-username">{{ $user->username }}</a>
    </div>
    @endforeach
</div>

@endsection