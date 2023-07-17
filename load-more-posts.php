<?php

include 'functions.php';
session_start();


$offset = $_POST['offset'];
$limit = $_POST['limit'];


loadMorePosts($offset, $limit);

function loadMorePosts($offset, $limit) {
    include_once 'db_conn.php';

    $query = "SELECT * FROM posts
              ORDER BY RAND()
              LIMIT $limit OFFSET $offset";

    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['user_id'];
            $likes = $row['likes'];
            $postID = $row['post_id'];
            $s = loadUsername($id, $conn);
            $PFP = getPFP($id, $conn);
            generatePost($s, $id, $row['content'], $likes, $postID, $PFP);
        }
    } else {
        echo 'No more posts found.';
    }

    $conn->close();
}
