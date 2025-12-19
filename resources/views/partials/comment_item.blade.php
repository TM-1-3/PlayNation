@props(['comment', 'postId'])

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
            
            <div class="absolute top-2 right-2 flex gap-1">
                @if(auth()->check() && auth()->id() === $comment->id_creator)
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
                @else
                    <button onclick="toggleReport('comment', {{ $comment->id_comment }})" 
                            class="text-gray-600 hover:text-red-600 bg-transparent border-none cursor-pointer p-1" 
                            title="Report comment">
                        <i class="fa-solid fa-flag text-xs"></i>
                    </button>
                @endif
            </div>
        </div>
        <span class="text-xs text-gray-400 ml-3 mt-1 inline-block">
            {{ \Carbon\Carbon::parse($comment->date)->diffForHumans() }}
        </span>
    </div>
</div>

{{-- report modal for this comment --}}
@include('partials.report-modal', [
    'title' => 'Report Comment',
    'target_type' => 'comment',
    'target_id' => $comment->id_comment,
])
