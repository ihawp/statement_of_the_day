<?php

include 'functions.php';
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    header('Location: home.php');
} else {


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="flex-column center-hor">
<form id="register-form" class="flex-column center-vert center-hor height-100" action="registerVerify.php" method="POST">
    <input type="text" placeholder="email" name="email" required>
    <input type="text" placeholder="username" name="username" required>
    <input type="password" placeholder="password" name="password" required>
    <button type="submit">submit</button>
    <?php
    // register error handling
    if (isset($_GET['error'])) {
        $e = $_GET['error'];
        logregCallError($e);
    } ?>
</form>
<script src="https://kit.fontawesome.com/99a47fae58.js" crossorigin="anonymous"></script>
<script src="main.js"></script>
</body>
</html>
<?php
}
?>
