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
    .then(response => {
        if (response.status === 403) {
            return response.json().then(data => {
                if (typeof showErrorModal === 'function') {
                    showErrorModal(data.error || 'You cannot perform this action.');
                } else {
                    alert(data.error || 'You cannot perform this action.');
                }
                throw new Error('Forbidden');
            });
        }
        return response.json();
    })
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
        if (error.message !== 'Forbidden') {
            console.error('Error toggling like:', error);
        }
    });
}

function toggleComments(postId) {
    const modal = document.getElementById(`comments-modal-post-${postId}`);
    const commentsItems = document.getElementById(`comments-items-${postId}`);
    
    if (modal.classList.contains('hidden')) {
        modal.classList.remove('hidden');
        document.documentElement.classList.add('overflow-hidden');
        document.body.classList.add('overflow-hidden');
        
        // Fetch comments as rendered HTML from server (Blade partial)
        fetch(`/post/${postId}/comments?format=html`, {
            headers: {
                'Accept': 'text/html'
            }
        })
            .then(response => response.text())
            .then(html => {
                if (!commentsItems) return;
                commentsItems.innerHTML = html && html.trim().length > 0
                    ? html
                    : '<div class="text-center text-gray-500 py-4">No comments yet. Be the first to comment!</div>';
                
                // Initialize tagging AFTER comments are loaded
                setTimeout(() => {
                    const commentInput = document.getElementById(`comment-input-${postId}`);
                    if (commentInput && typeof initializeCommentTagging === 'function') {
                        console.log('Initializing tagging on modal open'); // Debug log
                        initializeCommentTagging(`comment-input-${postId}`, postId);
                    }
                }, 150);
            })
            .catch(error => {
                if (commentsItems) {
                    commentsItems.innerHTML = '<div class="text-center text-red-500 py-4">Error loading comments</div>';
                }
                console.error('Error:', error);
            });
    } else {
        modal.classList.add('hidden');
        document.documentElement.classList.remove('overflow-hidden');
        document.body.classList.remove('overflow-hidden');
        
        // Clear search input when closing modal
        const searchInput = document.getElementById(`search-input-comment-${postId}`);
        if (searchInput) {
            searchInput.value = '';
        }
    }
}

function toggleCommentLike(commentId, postId) {
    fetch(`/comment/${commentId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const icon = document.getElementById(`comment-like-icon-${commentId}`);
            const count = document.getElementById(`comment-like-count-${commentId}`);
            
            if (data.liked) {
                icon.classList.remove('fa-regular');
                icon.classList.add('fa-solid', 'text-red-600');
            } else {
                icon.classList.remove('fa-solid', 'text-red-600');
                icon.classList.add('fa-regular');
            }
            
            count.textContent = data.like_count;
        }
    })
    .catch(error => {
        console.error('Error toggling comment like:', error);
    });
}

function addComment(event, postId) {
    event.preventDefault();
    
    const form = event.target;
    const input = document.getElementById(`comment-input-${postId}`);
    const commentText = input.value.trim();
    
    if (!commentText) return;
    
    // Use FormData instead of JSON
    const formData = new FormData();
    formData.append('comment_text', commentText);
    
    // Show loading state
    const submitButton = form.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.textContent;
    submitButton.disabled = true;
    submitButton.textContent = 'Posting...';
    
    fetch(`/post/${postId}/comment`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => {
        if (response.status === 403) {
            return response.json().then(data => {
                if (typeof showErrorModal === 'function') {
                    showErrorModal(data.error || 'You cannot perform this action.');
                } else {
                    alert(data.error || 'You cannot perform this action.');
                }
                throw new Error('Forbidden');
            });
        }
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            console.log('Comment posted successfully:', data);
            
            // Clear input immediately
            input.value = '';
            
            // Re-enable button
            submitButton.disabled = false;
            submitButton.textContent = originalButtonText;
            
            // Update comment count IMMEDIATELY in the post card
            const commentCountElement = document.querySelector(`#post-${postId} .fa-comment`).nextElementSibling;
            if (commentCountElement) {
                const currentCount = parseInt(commentCountElement.textContent) || 0;
                commentCountElement.textContent = currentCount + 1;
            }
            
            // Add a small delay before reloading to ensure database write is complete
            setTimeout(() => {
                const commentsItems = document.getElementById(`comments-items-${postId}`);
                
                fetch(`/post/${postId}/comments?format=html`, {
                    headers: {
                        'Accept': 'text/html'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch comments');
                    }
                    return response.text();
                })
                .then(html => {
                    console.log('Comments reloaded successfully');
                    if (commentsItems) {
                        commentsItems.innerHTML = html;
                    }
                    
                    // Reinitialize tagging after reload
                    setTimeout(() => {
                        const commentInput = document.getElementById(`comment-input-${postId}`);
                        if (commentInput && typeof initializeCommentTagging === 'function') {
                            console.log('Reinitializing tagging after comment post');
                            initializeCommentTagging(`comment-input-${postId}`, postId);
                        }
                    }, 100);
                })
                .catch(error => {
                    console.error('Error reloading comments:', error);
                    // Don't show error alert since comment was posted successfully
                    // Just log it and the user will see it on page refresh
                    console.log('Comment was posted but failed to reload list. Refresh the page to see it.');
                });
            }, 300); // Wait 300ms for database write to complete
        } else {
            throw new Error('Failed to post comment');
        }
    })
    .catch(error => {
        // Re-enable button on error
        submitButton.disabled = false;
        submitButton.textContent = originalButtonText;
        
        if (error.message !== 'Forbidden') {
            console.error('Error adding comment:', error);
            // Check if comment was actually posted by trying to reload
            setTimeout(() => {
                const commentsItems = document.getElementById(`comments-items-${postId}`);
                fetch(`/post/${postId}/comments?format=html`, {
                    headers: {
                        'Accept': 'text/html'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    if (commentsItems) {
                        commentsItems.innerHTML = html;
                    }
                    // Clear input since comment might have been posted
                    input.value = '';
                    
                    // Reinitialize tagging
                    setTimeout(() => {
                        const commentInput = document.getElementById(`comment-input-${postId}`);
                        if (commentInput && typeof initializeCommentTagging === 'function') {
                            initializeCommentTagging(`comment-input-${postId}`, postId);
                        }
                    }, 100);
                })
                .catch(err => {
                    console.error('Failed to reload comments:', err);
                    alert('Failed to add comment. Please try again.');
                });
            }, 500);
        }
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
                   class="h-[2em] block w-full px-3 py-3 border border-white rounded-lg shadow-md text-gray-900 focus:border-blue-500 bg-white outline-none">
            <button onclick="saveCommentEdit(${commentId}, ${postId})" 
                    class="h-[2em] bg-blue-500 text-white border-none py-1 px-3 rounded-lg text-base cursor-pointer transition-colors whitespace-nowrap hover:bg-blue-600 text-sm">
                Save
            </button>
            <button onclick="cancelCommentEdit(${commentId}, '${currentText.replace(/'/g, "\\'")}', ${postId})" 
                    class="h-[2em] bg-gray-400 text-white border-none py-1 px-3 rounded-lg text-base cursor-pointer transition-colors whitespace-nowrap hover:bg-gray-500 text-sm">
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
    .then(response => {
        if (response.status === 403) {
            return response.json().then(data => {
                if (typeof showErrorModal === 'function') {
                    showErrorModal(data.error || 'You cannot perform this action.');
                } else {
                    alert(data.error || 'You cannot perform this action.');
                }
                throw new Error('Forbidden');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Reload comments to show updated text
            toggleComments(postId);
            setTimeout(() => toggleComments(postId), 100);
        }
    })
    .catch(error => {
        if (error.message !== 'Forbidden') {
            console.error('Error updating comment:', error);
            alert('Failed to update comment. Please try again.');
        }
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
    .then(response => {
        if (response.status === 403) {
            return response.json().then(data => {
                if (typeof showErrorModal === 'function') {
                    showErrorModal(data.error || 'You cannot perform this action.');
                } else {
                    alert(data.error || 'You cannot perform this action.');
                }
                throw new Error('Forbidden');
            });
        }
        return response.json();
    })
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
            const commentsItems = document.getElementById(`comments-items-${postId}`);
            if (data.comment_count === 0) {
                if (commentsItems) {
                    commentsItems.innerHTML = '<div class="text-center text-gray-500 py-4">No comments yet. Be the first to comment!</div>';
                }
            }
        }
    })
    .catch(error => {
        if (error.message !== 'Forbidden') {
            console.error('Error deleting comment:', error);
            alert('Failed to delete comment. Please try again.');
        }
    });
}