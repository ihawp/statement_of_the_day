<?php

include_once 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have the post ID available
    $postID = $_POST['postID'];

    // Check if the user has already liked the post
    $userID = $_SESSION['id'];
    $query = "SELECT * FROM post_likes WHERE post_id = '$postID' AND user_id = '$userID'";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        // User has already liked the post, handle accordingly (e.g., remove the like)
        // ...
        echo "You have already liked this post.";
    } else {
        // User has not liked the post, proceed with adding the like
        $insertQuery = "INSERT INTO post_likes (post_id, user_id) VALUES ('$postID', '$userID')";
        $insertResult = $conn->query($insertQuery);
        if ($insertResult) {
            // Update the likes count in the posts table
            $updateQuery = "UPDATE posts SET likes = likes + 1 WHERE post_id = '$postID'";
            $updateResult = $conn->query($updateQuery);
            if ($updateResult) {
                echo "Liked!";
            } else {
                echo "Failed to update likes count.";
            }
        } else {
            echo "Failed to add like.";
        }
    }
}

$conn->close();

?>

