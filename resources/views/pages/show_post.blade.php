@extends('layouts.app')

@section('title', 'View Post')

@section('content')
<div class="max-w-2xl mx-auto mt-6 px-4">
    
    {{-- back btn --}}
    <div class="mb-4">
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-blue-600 font-semibold transition group no-underline">
            <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> 
            Back
        </a>
    </div>

    {{-- reuse posts partial --}}
    {{-- we use type home so that it looks consistent --}}
    @include('partials.post', ['post' => $post, 'type' => 'home'])

</div>

@endsection