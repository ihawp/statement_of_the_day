<?php

session_start();
include_once 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have the post ID available
    $postID = $_POST['post_id'];
    $posterID = $_POST['poster_id'];
    $likerID = $_SESSION['id'];

    // Check if the user has already liked the post
    $query = "SELECT * FROM post_likes WHERE post_id = '$postID' AND poster_id = '$posterID' AND liker_id = '$likerID'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // User has already liked the post, so unlike it
        $deleteQuery = "DELETE FROM post_likes WHERE post_id = '$postID' AND poster_id = '$posterID' AND liker_id = '$likerID'";
        $deleteResult = $conn->query($deleteQuery);
        if ($deleteResult) {
            // Update the likes count in the posts table
            $updateQuery = "UPDATE posts SET likes = likes - 1 WHERE post_id = '$postID'";
            $updateResult = $conn->query($updateQuery);
            if ($updateResult) {
                echo "Unliked.";
            } else {
                echo "Failed to update likes count.";
            }
        } else {
            echo "Failed to unlike.";
        }
    } else {
        // User has not liked the post, so like it
        $insertQuery = "INSERT INTO post_likes (post_id, poster_id, liker_id) VALUES ('$postID', '$posterID', '$likerID')";
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