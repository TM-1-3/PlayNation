@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="centered-content">
    <div style="margin-top: 50px;">
        <i class="fa-solid fa-person-digging" style="font-size: 4rem; color: #d2afe7; margin-bottom: 20px;"></i>
        <h1>{{ $title }}</h1>
        <p>This feature is currently under development.</p>
        <p><em>"No content yet."</em></p>
        
        <a href="{{ url('/') }}" class="button button-outline">Back to Feed</a>
    </div>
</div>
@endsection