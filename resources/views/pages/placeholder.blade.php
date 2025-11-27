@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="text-center">
        <i class="fa-solid fa-person-digging text-6xl text-blue-500 mb-5"></i>
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $title }}</h1>
        <p class="text-gray-600 mb-2">This feature is currently under development.</p>
        <p class="text-gray-500 italic mb-6">"No content yet."</p>
        
        <a href="{{ route('home') }}" class="inline-block px-6 py-2 border-2 border-blue-500 text-blue-500 rounded-lg no-underline font-semibold transition-colors hover:bg-blue-500 hover:text-white">Back to Feed</a>
    </div>
</div>
@endsection