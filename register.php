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
<form id="register-form" class="flex-column center-vert center-hor height-100" action="registerVerify.php" method="POST">
    <h1 id="logreg-text">register</h1>
    <input id="logreg-input" type="email" placeholder="email" name="email" required>
    <input id="logreg-input" type="text" placeholder="username" name="username" required>
    <input id="logreg-input" type="password" placeholder="password" name="password" required>
    <button type="submit">submit</button>
    <?php
    // register error handling
    if (isset($_GET['error'])) {
        $e = $_GET['error'];
        callError($e);
    } ?>
    <p>Already have an account? <a id="logreg-link" href="login.php">Login.</a></p>
</form>
<script src="https://kit.fontawesome.com/99a47fae58.js" crossorigin="anonymous"></script>
<script src="jquery1.js"></script>
</body>
</html>
