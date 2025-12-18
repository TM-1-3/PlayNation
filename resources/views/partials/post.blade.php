{{-- likes modal (hidden) --}}
<div id="likes-modal-{{ $post->id_post }}" class="hidden fixed inset-0 bg-black/50 z-[9999] flex items-center justify-center backdrop-blur-sm" onclick="if(event.target === this) toggleLikes({{ $post->id_post }})">
    <div class="bg-white rounded-lg w-full max-w-md max-h-96 overflow-hidden">
        <div class="flex justify-between items-center p-4 border-b">
            <h4 class="font-semibold text-lg">Liked by</h4>
            <button onclick="toggleLikes({{ $post->id_post }})" class="text-gray-600 hover:text-gray-800 font-bold text-2xl leading-none">&times;</button>
        </div>
        <div id="likes-list-{{ $post->id_post }}" class="p-4 overflow-y-auto max-h-80">
            <div class="text-center text-gray-500">Loading...</div>
        </div>
    </div>
</div>

{{-- comments modal include --}}
@include('partials.comments_modal', [
    'modalId' => "comments-modal-post-{$post->id_post}",
    'postId' => $post->id_post,
])

{{-- report modal include --}}
@include('partials.report_modal', [
    'modalId' => "report-modal-post-{$post->id_post}",
    'action' => route('post.report', $post->id_post),
    'title' => 'Report Post',
    'target_type' => 'post',
    'target_id' => $post->id_post,
])

<div class="bg-white border border-gray-200 rounded-lg mb-5 text-left flex flex-col" id="post-{{ $post->id_post }}">

    <div class="flex items-center p-3.5">
        <a href="{{ route('profile.show', $post->user->id_user) }}" class="relative group mr-2.5" title="Click here to go to the author's profile page">
            <img class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5" 
                src="{{ $post->user->getProfileImage() }}" 
                alt="avatar">
        </a>
        <a href="{{ route('profile.show', $post->user->id_user) }}" class="relative group font-semibold text-sm text-gray-800 no-underline" title="Click here to go to the author's profile page">
            {{ $post->user->username }}
            @if($post->user->verifiedUser)
                <i class="fa-solid fa-circle-check text-blue-500 text-[12px]"></i>
            @endif
        </a>
        
        <span class="ml-auto text-xs text-gray-500 pr-4">{{ \Carbon\Carbon::parse($post->date)->diffForHumans() }}</span>

        @if($type == 'profile' && Auth::check() && Auth::id() == $post->id_creator)
            <div>
                <a href="{{ route('post.edit', $post->id_post) }}" class="text-black py-1 px-1 text-sm no-underline" title="Edit your post">Edit</a>
            </div>
        @else
            <div>
                <button onclick="toggleReport('post', {{ $post->id_post }})" class="text-black py-1 px-1 text-xl no-underline bg-transparent border-none cursor-pointer" title="Report the post">⋮</button>
            </div>
        @endif
    </div>

    @if($post->image)
        <img class="w-full block border-t border-gray-200" src="{{ $post->getPostImage() }}" alt="Post Content">
    @endif
    
    <div class="flex items-center gap-4 px-4 pt-2">
        <div class="flex items-center gap-4 px-4 pt-2">
            @php
                $isLiked = isset($likedPostIds) && in_array($post->id_post, $likedPostIds);
            @endphp
            <button onclick="toggleLike({{ $post->id_post }})" 
                    id="like-btn-{{ $post->id_post }}"
                    class="flex items-center gap-1 text-gray-600 bg-transparent border-none cursor-pointer hover:text-red-600" 
                    title="Like">
                <i class="{{ $isLiked ? 'fa-solid text-red-600' : 'fa-regular' }} fa-heart text-lg" id="like-icon-{{ $post->id_post }}"></i>
                <span class="text-sm" id="like-count-{{ $post->id_post }}" onclick="event.stopPropagation(); toggleLikes({{ $post->id_post }})" style="cursor:pointer;">
                    {{ $post->likes_count ?? $post->likes->count() }}
                </span>
            </button>
            <button onclick="toggleComments({{ $post->id_post }})" class="flex items-center gap-1 text-gray-600 bg-transparent border-none cursor-pointer hover:text-blue-600" title="View comments">
                <i class="fa-regular fa-comment text-lg"></i>
                <span class="text-sm">{{ $post->comments_count ?? $post->comments->count() }}</span>
            </button>
            <button class="flex items-center gap-1 text-gray-600 bg-transparent border-none cursor-pointer" title="Share">
                <i class="fa-regular fa-share-from-square text-lg"></i>
                <span class="text-sm">Share</span>
            </button>
            <form action="{{ route('post.save', $post->id_post) }}" method="POST" class="ml-auto">
                @csrf
                @php
                    $isSaved = isset($savedPostIds) && in_array($post->id_post, $savedPostIds);
                @endphp
                <button class="flex items-center gap-1 text-gray-600 bg-transparent border-none cursor-pointer" title="Save">
                    <i class="{{ $isSaved ? 'fa-solid' : 'fa-regular' }} fa-bookmark text-lg"></i>
                    <span class="text-sm">{{ $isSaved ? 'Saved' : 'Save' }}</span>
                </button>
            </form>
        </div>
    </div>
    
    <div class="py-3 px-4 text-sm leading-relaxed">
        @if($post->user)
            <a href="{{ route('profile.show', $post->user->id_user) }}" class="font-semibold mr-1 text-gray-800 no-underline" title="Click here to go to the author's profile page">
                {{ $post->user->username }}
            </a>
        @endif
        {{ $post->description }}
    </div>

    @if($post->labels->isNotEmpty())
        <div class="px-4 pb-4 flex gap-1 flex-wrap">
            @foreach($post->labels as $label)
                <span class="bg-blue-500 text-white text-xs py-1 px-2 rounded font-semibold">{{ $label->designation }}</span>
            @endforeach
        </div>
    @endif
</div>

<script>
function toggleLikes(postId) {
    const modal = document.getElementById(`likes-modal-${postId}`);
    const likesList = document.getElementById(`likes-list-${postId}`);
    
    if (modal.classList.contains('hidden')) {
        modal.classList.remove('hidden');
        
        fetch(`/post/${postId}/likes`)
            .then(response => response.json())
            .then(data => {
                if (data.likers.length === 0) {
                    likesList.innerHTML = '<div class="text-center text-gray-500">No likes yet</div>';
                } else {
                    likesList.innerHTML = data.likers.map(user => `
                        <a href="/profile/${user.id_user}" class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded no-underline">
                            <img src="${user.profile_picture}" alt="${user.username}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                            <div>
                                <div class="font-semibold text-gray-800">${user.username}</div>
                                <div class="text-sm text-gray-500">${user.name}</div>
                            </div>
                        </a>
                    `).join('');
                }
            })
            .catch(error => {
                likesList.innerHTML = '<div class="text-center text-red-500">Error loading likes</div>';
                console.error('Error:', error);
            });
    } else {
        modal.classList.add('hidden');
    }
}

function toggleLike(postId) {
    fetch(`/post/${postId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        const icon = document.getElementById(`like-icon-${postId}`);
        const count = document.getElementById(`like-count-${postId}`);
        
        if (data.liked) {
            icon.classList.remove('fa-regular');
            icon.classList.add('fa-solid', 'text-red-600');
        } else {
            icon.classList.remove('fa-solid', 'text-red-600');
            icon.classList.add('fa-regular');
        }
        
        count.textContent = data.like_count;
    })
    .catch(error => {
        console.error('Error toggling like:', error);
    });
}

function toggleComments(postId) {
    const modal = document.getElementById(`comments-modal-post-${postId}`);
    const commentsList = document.getElementById(`comments-list-${postId}`);
    
    if (modal.classList.contains('hidden')) {
        modal.classList.remove('hidden');
        
        // Fetch comments
        fetch(`/post/${postId}/comments`)
            .then(response => response.json())
            .then(data => {
                if (data.comments.length === 0) {
                    commentsList.innerHTML = '<div class="text-center text-gray-500 py-4">No comments yet. Be the first to comment!</div>';
                } else {
                    commentsList.innerHTML = data.comments.map(comment => `
                        <div class="flex gap-3 mb-4 pb-4 border-b border-gray-100 last:border-0">
                            <a href="/profile/${comment.user.id_user}" class="flex-shrink-0">
                                <img src="${comment.user.profile_picture}" 
                                     alt="${comment.user.username}" 
                                     class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                            </a>
                            <div class="flex-1 min-w-0">
                                <div class="bg-gray-50 rounded-lg px-3 py-2">
                                    <a href="/profile/${comment.user.id_user}" 
                                       class="font-semibold text-sm text-gray-900 no-underline hover:underline">
                                        ${comment.user.username}
                                    </a>
                                    <p class="text-sm text-gray-700 mt-1 break-words">${comment.text}</p>
                                </div>
                                <span class="text-xs text-gray-400 ml-3 mt-1 inline-block">
                                    ${comment.date}
                                </span>
                            </div>
                        </div>
                    `).join('');
                }
            })
            .catch(error => {
                commentsList.innerHTML = '<div class="text-center text-red-500 py-4">Error loading comments</div>';
                console.error('Error:', error);
            });
    } else {
        modal.classList.add('hidden');
    }
}

function addComment(event, postId) {
    event.preventDefault();
    
    const form = event.target;
    const input = document.getElementById(`comment-input-${postId}`);
    const commentText = input.value.trim();
    
    if (!commentText) return;
    
    fetch(`/post/${postId}/comment`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ comment_text: commentText })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear input
            input.value = '';
            
            // Reload comments to show the new one
            toggleComments(postId);
            setTimeout(() => toggleComments(postId), 100);
            
            // Update comment count in the post
            const countElement = document.querySelector(`#post-${postId} .fa-comment`).nextElementSibling;
            if (countElement) {
                const currentCount = parseInt(countElement.textContent) || 0;
                countElement.textContent = currentCount + 1;
            }
        }
    })
    .catch(error => {
        console.error('Error adding comment:', error);
        alert('Failed to add comment. Please try again.');
    });
}
</script>