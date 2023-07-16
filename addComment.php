<?php
session_start();
include 'db_conn.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parent_comment_id = null;
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['id'];
    $content = htmlspecialchars($_POST['content']);
    if ($content === "") {
        header('Location: home.php?theresnothinginthemessagebox');
        exit;
    }

    $query = "INSERT INTO comments (parent_comment_id, post_id, user_id, content, timestamp) VALUES ('$parent_comment_id', '$post_id', '$user_id', '$content', CURRENT_TIMESTAMP())";
    $result = $conn->query($query);
    if ($result) {
        echo 'true';
    } else {
        echo 'false';
    }

    $conn->close();
}