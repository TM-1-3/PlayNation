@extends('layouts.app')

@section('title', $user->name . "'s Friends")

@section('content')

<div class="max-w-4xl mx-auto pt-10 px-4">
    <div class="mb-6 relative flex items-center justify-center">
        <h1 class="text-2xl font-bold text-gray-800 text-center">
            {{ $user->username }}'s Friends
        </h1>
    </div>

    {{-- Friends List --}}
    @if($friends->isEmpty())
        <div class="text-center text-gray-500 mt-10 p-8 bg-gray-50 rounded-lg border border-gray-100">
            <p>This user has no friends yet.</p>
        </div>
    @else
        {{-- Vertical Stack Container (Instagram Style) --}}
        <div class="flex flex-col gap-2 max-w-3xl mx-auto">
            @foreach($friends as $friend)
                
                @include('partials.friend', ['friend' => $friend, 'user' => $user])

            @endforeach
        </div>
    @endif
</div>

@endsection