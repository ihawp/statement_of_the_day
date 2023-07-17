// ihawp


// load-more-posts.php
function loadMorePosts() {
    $(document).ready(function() {
        var offset = 5; // Initial offset value
        var limit = 5; // Number of posts to load on each "Load More" click

        function loadPosts() {
            $.ajax({
                url: "load-more-posts.php",
                type: "POST",
                data: { offset: offset, limit: limit },
                success: function(response) {
                    if (response !== '') {
                        $("#posts-box").append(response);
                        offset += limit;
                    } else {
                        $$("#posts-box").append('no mnore posts');
                    }
                },
                error: function() {
                    alert("Error loading more posts.");
                }
            });
        }

        $("#load-more-button").on("click", function() {
            loadPosts(limit);
        });

        // Initial load
        loadPosts(limit);
    });
}

function viewPost(postID, username) {
    window.location.href = 'viewpost.php?postID=' + postID + '&username=' + username;
}





function addLike(event, postID, posterID) {
    event.stopPropagation();
    $(document).ready(function() {
        $.ajax({
            url: "addPostLike.php",
            type: "POST",
            data: { post_id: postID, poster_id: posterID },
            success: function(response) {
                var wow = document.getElementById(`post-likes-count-${postID}`);
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


function displayCommentBox(event, postID) {
    event.stopPropagation();
    const main = document.getElementById("comment-popup");
    main.style.display = 'flex';
    main.scrollIntoView({ behavior: "smooth", block: "start" });
    const wow = document.getElementById("add-comment-button-div");
    wow.innerHTML = `
    <button id="post-comment-button" onclick="addComment('${postID}')">post comment</button>
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
                        ${callSuccess('your comment was posted!')}
                    `;
                    setTimeout(function() {
                        stopDisplayCommentBox();
                    }, 2000);
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
    return `
        <div id="error-box" class="flex-row center-hor">
            <h1><i class="fa-solid fa-circle-exclamation noti-icon"></i> ${error}</h1>
        </div>
    `;
}
function callSuccess(success) {
    return `
        <div id="success-box" class="flex-row center-hor">
            <h1><i class="fa-solid fa-check"></i> ${success}</h1>
        </div>
    `;
}

function addFollower(pbfID) {
    const followButton = document.getElementById("follow-button");
    const followCount = document.getElementById("follow-count");
    var change = parseInt(followCount.innerText);
    $(document).ready(function() {
        $.ajax({
            url: "addFollower.php",
            type: "POST",
            data: { person_being_followed: pbfID },
            success: function(response) {
                if (response === 'true') {
                    change += 1;
                    followCount.innerText = change;
                    followButton.innerText = 'unfollow';
                } else if (response === 'false') {
                    change -= 1;
                    followCount.innerText = change;
                    followButton.innerText = 'follow';
                }
            },
            error: function() {
                console.log("AJAX request failed.");
            }
        });
    });
}