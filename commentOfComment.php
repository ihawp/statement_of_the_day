<?php

session_start();
include 'db_conn.php';
checkLogin();

$parent_comment_id = null;
$post_id = $_POST['post_id'];
$user_id = $_POST['user_id'];
$content = $_POST['content'];

$query = "INSERT INTO comments (parent_comment_id, post_id, user_id, content, timestamp) VALUES ($parent_comment_id, $post_id, $user_id, $content, NOW())";
