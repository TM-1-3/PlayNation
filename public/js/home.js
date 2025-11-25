$(document).ready(function() {
    $('.button-delete').on('click', function() {
        let idPost = $(this).data('id');
        let postElement = $('#post-' + idPost);

        if(!confirm('Are you sure you want to delete this post?')) return;


        $.ajax({
            url: '/post/' + postId,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    postElement.fadeOut(300, function() { $(this).remove(); });
                } else {
                    alert('Error deleting post');
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Something went wrong!');
            }
        });
    });
});