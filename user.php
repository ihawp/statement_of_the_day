<?php

session_start();
include 'functions.php';
checkLogin();

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

if (isset($_GET['viewuser'])) {
    $viewuser = $_GET['viewuser'];
    if ($viewuser === $_SESSION['username']) {
        header('Location: profile.php');
    } else {
        loadViewingPosts($viewuser);?>
    <?php }
} else {
    echo 'No posts found.';
}

loadFooter();
?>
<script src="https://kit.fontawesome.com/99a47fae58.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="main.js"></script>
</body>
</html>


