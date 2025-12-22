@if($comments->isEmpty())
    <div class="text-center text-gray-500 py-4">No comments yet. Be the first to comment!</div>
@else
    @foreach($comments as $comment)
        {{-- Report modal for this comment --}}
        @include('partials.report-modal', [
            'title' => 'Report Comment',
            'target_type' => 'comment',
            'target_id' => $comment->id_comment,
        ])

        <div class="flex gap-3 mb-4 pb-4 border-b border-gray-100 last:border-0" id="comment-{{ $comment->id_comment }}">
            <a href="{{ route('profile.show', $comment->user->id_user) }}" class="flex-shrink-0">
                <img src="{{ $comment->user->getProfileImage() }}" 
                     alt="{{ $comment->user->username }}" 
                     class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
            </a>
            <div class="flex-1 min-w-0">
                <div class="bg-gray-50 rounded-lg px-3 py-2 relative">
                    <a href="{{ route('profile.show', $comment->user->id_user) }}" 
                       class="font-semibold text-sm text-gray-900 no-underline hover:underline">
                        {{ $comment->user->username }}
                    </a>
                    <p class="text-sm text-gray-700 mt-1 break-words" id="comment-text-{{ $comment->id_comment }}">{{ $comment->text }}</p>
                    
                    @if(Auth::check() && Auth::id() === $comment->id_user)
                        <div class="absolute top-2 right-2 flex gap-1">
                            <button onclick="editComment({{ $comment->id_comment }}, '{{ addslashes($comment->text) }}', {{ $postId }})" 
                                    class="text-blue-600 hover:text-blue-800 bg-transparent border-none cursor-pointer p-1" 
                                    title="Edit comment">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </button>
                            <button onclick="deleteComment({{ $comment->id_comment }}, {{ $postId }})" 
                                    class="text-red-600 hover:text-red-800 bg-transparent border-none cursor-pointer p-1" 
                                    title="Delete comment">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </div>
                    @else
                        <button onclick="toggleReport('comment', {{ $comment->id_comment }})" 
                                class="absolute top-2 right-2 text-gray-600 hover:text-red-600 bg-transparent border-none cursor-pointer p-1" 
                                title="Report comment">
                            <i class="fa-solid fa-flag text-xs"></i>
                        </button>
                    @endif
                </div>
                <div class="flex items-center justify-between ml-3 mt-1">
                    {{-- Likes on the left --}}
                    @php
                        $isLiked = isset($likedCommentIds) && in_array($comment->id_comment, $likedCommentIds);
                    @endphp
                    <button onclick="toggleCommentLike({{ $comment->id_comment }}, {{ $postId }})" 
                            id="comment-like-btn-{{ $comment->id_comment }}"
                            class="flex items-center gap-1 text-gray-600 bg-transparent border-none cursor-pointer hover:text-red-600 text-xs" 
                            title="Like comment">
                        <i class="{{ $isLiked ? 'fa-solid text-red-600' : 'fa-regular' }} fa-heart" id="comment-like-icon-{{ $comment->id_comment }}"></i>
                        <span id="comment-like-count-{{ $comment->id_comment }}">{{ $comment->likes_count ?? 0 }}</span>
                    </button>
                    
                    {{-- Date on the right --}}
                    <span class="text-xs text-gray-400">
                        {{ \Carbon\Carbon::parse($comment->date)->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div>
    @endforeach
@endif