<?php


include 'db_conn.php';
include 'functions.php';
session_start();
checkLogin();

$user_id = $_SESSION['id'];
$new_bio = htmlspecialchars($_POST['bio-box']);

$query = "UPDATE accounts SET bio = '$new_bio' WHERE id = '$user_id';";
$result = $conn->query($query);
if ($result) {
    header('Location: settings.php?success');
} else {
    header('Location: settings.php?bio_not_updated');
}
$conn->close();