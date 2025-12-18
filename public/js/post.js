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
                        <div class="flex gap-3 mb-4 pb-4 border-b border-gray-100 last:border-0" id="comment-${comment.id_comment}">
                            <a href="/profile/${comment.user.id_user}" class="flex-shrink-0">
                                <img src="${comment.user.profile_picture}" 
                                     alt="${comment.user.username}" 
                                     class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                            </a>
                            <div class="flex-1 min-w-0">
                                <div class="bg-gray-50 rounded-lg px-3 py-2 relative">
                                    <a href="/profile/${comment.user.id_user}" 
                                       class="font-semibold text-sm text-gray-900 no-underline hover:underline">
                                        ${comment.user.username}
                                    </a>
                                    <p class="text-sm text-gray-700 mt-1 break-words" id="comment-text-${comment.id_comment}">${comment.text}</p>
                                    
                                    ${comment.is_owner ? `
                                        <div class="absolute top-2 right-2 flex gap-1">
                                            <button onclick="editComment(${comment.id_comment}, '${comment.text.replace(/'/g, "\\'")}', ${postId})" 
                                                    class="text-blue-600 hover:text-blue-800 bg-transparent border-none cursor-pointer p-1" 
                                                    title="Edit comment">
                                                <i class="fa-solid fa-pen text-xs"></i>
                                            </button>
                                            <button onclick="deleteComment(${comment.id_comment}, ${postId})" 
                                                    class="text-red-600 hover:text-red-800 bg-transparent border-none cursor-pointer p-1" 
                                                    title="Delete comment">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>
                                        </div>
                                    ` : ''}
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

function editComment(commentId, currentText, postId) {
    const commentTextElement = document.getElementById(`comment-text-${commentId}`);
    const originalHtml = commentTextElement.innerHTML;
    
    // Replace comment text with input field
    commentTextElement.innerHTML = `
        <div class="flex gap-2 mt-2">
            <input type="text" 
                   id="edit-input-${commentId}" 
                   value="${currentText}" 
                   class="flex-1 px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button onclick="saveCommentEdit(${commentId}, ${postId})" 
                    class="bg-blue-600 text-white px-3 py-1 text-sm rounded hover:bg-blue-700">
                Save
            </button>
            <button onclick="cancelCommentEdit(${commentId}, '${currentText.replace(/'/g, "\\'")}', ${postId})" 
                    class="bg-gray-400 text-white px-3 py-1 text-sm rounded hover:bg-gray-500">
                Cancel
            </button>
        </div>
    `;
    
    // Focus the input
    document.getElementById(`edit-input-${commentId}`).focus();
}

function saveCommentEdit(commentId, postId) {
    const newText = document.getElementById(`edit-input-${commentId}`).value.trim();
    
    if (!newText) {
        alert('Comment cannot be empty');
        return;
    }
    
    fetch(`/comment/${commentId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ text: newText })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload comments to show updated text
            toggleComments(postId);
            setTimeout(() => toggleComments(postId), 100);
        }
    })
    .catch(error => {
        console.error('Error updating comment:', error);
        alert('Failed to update comment. Please try again.');
    });
}

function cancelCommentEdit(commentId, originalText, postId) {
    document.getElementById(`comment-text-${commentId}`).innerHTML = originalText;
    // Reload to restore buttons
    toggleComments(postId);
    setTimeout(() => toggleComments(postId), 100);
}

function deleteComment(commentId, postId) {
    if (!confirm('Are you sure you want to delete this comment?')) {
        return;
    }
    
    fetch(`/comment/${commentId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove comment from DOM
            document.getElementById(`comment-${commentId}`).remove();
            
            // Update comment count in the post
            const countElement = document.querySelector(`#post-${postId} .fa-comment`).nextElementSibling;
            if (countElement) {
                countElement.textContent = data.comment_count;
            }
            
            // If no comments left, show empty state
            const commentsList = document.getElementById(`comments-list-${postId}`);
            if (data.comment_count === 0) {
                commentsList.innerHTML = '<div class="text-center text-gray-500 py-4">No comments yet. Be the first to comment!</div>';
            }
        }
    })
    .catch(error => {
        console.error('Error deleting comment:', error);
        alert('Failed to delete comment. Please try again.');
    });
}