<?php

include 'functions.php';
session_start();
alreadyLogged();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="flex-column center-hor">
<form id="login-form" class="flex-column center-vert center-hor height-100" action="loginVerify.php" method="POST">
    <input type="text" placeholder="username" name="username" required>
    <input type="password" placeholder="password" name="password" required>
    <button type="submit">submit</button required>
    <?php
    // login error handling
    if (isset($_GET['error'])) {
        $e = $_GET['error'];
        callError($e);
    } ?>
    <p>Don't have an account? <a href="register.php">Register.</a></p>
</form>
<script src="https://kit.fontawesome.com/99a47fae58.js" crossorigin="anonymous"></script>
<script src="jquery1.js"></script>
</body>
</html>
