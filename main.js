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

function displayCommentBox(postID) {
    const main = document.getElementById("comment-popup");
    main.style.display = 'flex';
    const wow = document.getElementById("add-comment-button-div");
    wow.innerHTML = `
    <button onclick="addComment('${postID}')">post comment</button>
`;
}

function stopDisplayCommentBox() {
    const comment = document.getElementById("comment-popup");
    comment.style.display = 'none';
}

function addComment(postID) {
    $(document).ready(function() {
        var content = $('#comment-box').val();

        $.ajax({
            url: "addComment.php",
            type: "POST",
            data: { post_id: postID, content: content },
            success: function(response) {
                if (response === 'true') { // wasn't accepting regular true and false, so I am using this for now!.
                    const main = document.getElementById("comment-popup");
                    main.innerHTML += `
                        ${callError('there was an success, dont try again!')}
                    `;
                } else if (response === 'false') {
                    const main = document.getElementById("comment-popup");
                    main.innerHTML += `
                        ${callError('there was an error, try again!')}
                    `;
                }
            },
            error: function() {
                // Handle AJAX error
                console.log("AJAX request failed.");
            }
        });
    });
}

function callError(error) {
    const wow = `
        <div id="error-box" class="flex-row center-hor width-100">
            <h1><i class="fa-solid fa-circle-exclamation noti-icon"></i> ${error}</h1>
        </div>
    `;
    return wow;
}