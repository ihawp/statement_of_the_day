<?php

session_start();
include_once 'db_conn.php';

$post = htmlspecialchars($_POST['post']);
if ($post === "") {
    header('Location: home.php?theresnothinginthemessagebox');
    exit;
}
$id = $_SESSION['id'];
$insertQuery = "INSERT INTO posts (user_id, content) VALUES ('$id', '$post')";
$insertResult = $conn->query($insertQuery);
if ($insertResult) {
    header('Location: home.php?posted=true');
} else {
    header('Location: home.php?posted=false');
}