<?php
include 'db_conn.php';
session_start();

$person_being_followed = $_POST['person_being_followed'];
$person_following = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if already following
    $checkQuery = "SELECT * FROM followers WHERE followed_id = '$person_being_followed' AND follower_id = '$person_following'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult && $checkResult->num_rows > 0) {
        // Already following, unfollow
        $unfollowQuery = "DELETE FROM followers WHERE followed_id = '$person_being_followed' AND follower_id = '$person_following'";
        $unfollowResult = $conn->query($unfollowQuery);

        if ($unfollowResult) {
            echo 'false';
        } else {
            echo 'true';
        }
    } else {
        // Not following, add follow
        $followQuery = "INSERT INTO followers (followed_id, follower_id) VALUES ('$person_being_followed', '$person_following')";
        $followResult = $conn->query($followQuery);

        if ($followResult) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}

$conn->close();
