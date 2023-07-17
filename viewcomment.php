<?php

session_start();
include 'functions.php';
checkLogin();

$postID = $_GET['postID'];
$username = $_GET['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="flex-column center-hor">
<?php
loadHeader();

loadPostANDComments($postID, $username, true);

loadFooter();
?>
<script src="https://kit.fontawesome.com/99a47fae58.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="main.js"></script>
</body>
</html>
