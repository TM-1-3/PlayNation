@props(['comments' => collect(), 'postId' => null])

@if($comments->isEmpty())
    <div class="text-center text-gray-500 py-4">No comments yet. Be the first to comment!</div>
@else
    @foreach($comments as $comment)
        @include('partials.comment_item', ['comment' => $comment, 'postId' => $postId])
    @endforeach
@endif
