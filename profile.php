<?php

include 'functions.php';
session_start();
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
    ?>

    <?php

    profileLoadPosts();

    loadFooter();
    ?>
    <script src="https://kit.fontawesome.com/99a47fae58.js" crossorigin="anonymous"></script>
    <script src="jquery1.js"></script>
    </body>
    </html>


