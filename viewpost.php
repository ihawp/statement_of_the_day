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
    <div id="comment-popup" class="blur-background position-absolute comment-box width-100 height-100 center-vert center-hor">
        <a onclick="stopDisplayCommentBox()"><i class="fa-solid fa-x"></i></a>
        <textarea class="no-resize width-30 height-15" id="comment-box" name="comment-box" placeholder="typasdasdsadsadsadsa" maxlength="255"></textarea>
        <div id="add-comment-button-div" class="flex-column width-5">
        </div>
    </div>
    <?php
    loadHeader();
    ?>

    <?php

    loadPostANDComments($postID, $username, false);

    loadFooter();
    ?>
    <script src="https://kit.fontawesome.com/99a47fae58.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="main.js"></script>
    </body>
    </html>
