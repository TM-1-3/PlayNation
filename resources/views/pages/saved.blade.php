@extends('layouts.app')

@section('title', 'Saved Posts')

@section('content')
<div class="max-w-3xl mx-auto p-5">
    <h1 class="text-2xl font-bold mb-5 text-gray-800">Saved Posts</h1>
    
    <div id="saved-posts" class="w-full pb-12">
        @if(isset($posts) && $posts->isEmpty())
            <div class="text-center py-10 text-gray-500">
                <p>No saved posts yet.</p>
                <p class="text-sm mt-1">Save posts to view them here later!</p>
            </div>
        @elseif(isset($posts))
            @foreach($posts as $post)
                @include('partials.post', ['post' => $post, 'type' => 'saved'])
            @endforeach
        @endif
    </div>
</div>
@endsection