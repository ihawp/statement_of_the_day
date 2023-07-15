
$(document).ready(function() {
    $("#like-btn").click(function(e) {
        e.preventDefault();
        addLike();
    });

    function addLike() {
        $.ajax({
            url: "addPostLike.php",
            type: "POST",
            success: function(response) {
                console.log(response);
            },
            error: function() {
                alert("Error loading more posts.");
            }
        });
    }
});