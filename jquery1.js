$(document).ready(function() {
    var offset = 5; // Initial offset value
    var limit = 5; // Number of posts to load on each "Load More" click

    $("#load-more-btn").click(function(e) {
        e.preventDefault();
        loadMorePosts();
    });

    function loadMorePosts() {
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
    }
});

