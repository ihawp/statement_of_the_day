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
<div class="width-50 flex-column center-hor">
    <form class="flex-column" action="postPost.php" method="POST">
        <textarea class="no-resize width-30 height-15" id="post-box" name="post" placeholder="type something funny" maxlength="255"></textarea>
        <div class="flex-column width-5">
            <button type="submit">post</button>
        </div>
    </form>
</div>
<div class="width-50 flex-column center-hor" id="posts-box">
    <?php
    loadPosts();
    ?>
</div>
<button id="load-more-btn">Load More</button>
<?php
loadFooter();
?>
<script src="https://kit.fontawesome.com/99a47fae58.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="jquery1.js"></script>
<script src="jquery2.js"></script>
</body>
</html>
<?php

?>

