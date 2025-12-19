@props(['modalId' => 'comments-modal', 'postId' => null, 'comments' => null])

<div id="{{ $modalId }}" class="hidden fixed inset-0 bg-black/50 z-[9999] flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-md overflow-hidden transform transition-all scale-100 mx-4 relative z-[10000]">
        <div class="p-4 border-b flex justify-between items-center bg-gray-50">
            <h3 class="font-bold text-gray-700 flex items-center gap-2">
                <i class="fa-regular fa-comment text-blue-500"></i> Comments
            </h3>
            <button onclick="toggleComments({{ $postId }})" class="text-gray-400 hover:text-gray-600 w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-200 transition">
                <i class="fa-solid fa-times text-lg"></i>
            </button>
        </div>

        <div class="flex justify-center mt-2">
            <form id="search-comment" action="{{ route('search.comments') }}" method="GET" class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>
                <input id="search-input-comment" type="text" name="search" placeholder="Search comments..." 
                    class="h-[2em] block w-90 mx-3 pl-10 pr-24 py-3 border-none rounded-lg shadow-md text-gray-900  bg-white outline-none">
                
            </form>
        </div>

        <div id="comments-list-{{ $postId }}" class="p-4 max-h-96 overflow-y-auto">
            <div id="comments-items-{{ $postId }}">
                @if(!is_null($comments))
                    @include('partials.comments_list', ['comments' => $comments, 'postId' => $postId])
                @else
                    <div class="text-center text-gray-500">Loading comments...</div>
                @endif
            </div>
        </div>

        {{-- Add comment form --}}
        @auth
        <div class="p-4 border-t bg-gray-50">
            <form id="add-comment-form-{{ $postId }}" onsubmit="addComment(event, {{ $postId }})" class="flex gap-2">
                @csrf
                <input type="text" 
                       name="comment_text" 
                       id="comment-input-{{ $postId }}"
                       placeholder="Write a comment..." 
                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition font-medium">
                    Post
                </button>
            </form>
        </div>
        @endauth
    </div>
</div>
