// ihawp


// load-more-posts.php
function loadMorePosts() {
    $(document).ready(function() {
        var offset = 5; // Initial offset value
        var limit = 5; // Number of posts to load on each "Load More" click
        $.ajax({
            url: "load-more-posts.php",
            type: "POST",
            data: { offset: offset, limit: limit },
            success: function(response) {
                $("#posts-box").append(response);
                offset += limit;
            },
            error: function() {
                alert("Error loading more posts.");
            }
        });
    });
}


function addLike(postID, posterID) {
    $(document).ready(function() {
            $.ajax({
                url: "addPostLike.php",
                type: "POST",
                data: { post_id: postID, poster_id: posterID },
                success: function(response) {
                    var wow = document.getElementById(`post-likes-count-${postID}`)
                    if (response === 'Liked!') {
                        let current = parseInt(wow.innerText);
                        wow.innerText = current + 1;
                    } else {
                        wow.innerText -= 1;
                    }
                },
                error: function() {
                    alert("error adding the like");
                }
            });
    });
}

function displayCommentBox() {
    const main = document.getElementById("comment-popup");
    main.style.display = 'flex';
}
function stopDisplayCommentBox() {
    const comment = document.getElementById("comment-popup");
    comment.style.display = 'none';
}
function addComment() {
    $(document).ready(function() {
        $.ajax({
            url: "addComment.php",
            type: "POST",
            data: { post_id: postID, poster_id: posterID },
            success: function(response) {
                var wow = document.getElementById(`post-likes-count-${postID}`)
                if (response === 'Liked!') {
                    let current = parseInt(wow.innerText);
                    wow.innerText = current + 1;
                } else {
                    wow.innerText -= 1;
                }
            },
            error: function() {
                alert("error adding the like");
            }
        });
    });
}