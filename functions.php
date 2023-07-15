<?php

// layout
function loadHeader() {
    echo '
<header class="flex-row center-hor center-vert height-10 width-100">
    <div class="width-40">
        <h1>statement of the day</h1>
    </div>
    <nav class="flex-row center-hor width-40">
        <a class="button" href="home.php"><i class="fa-solid fa-house"></i></i></a>
        <a class="button" href="profile.php"><i class="fa-solid fa-user"></i></a>
        <a class="button" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
    </nav>
</header>
    ';
}
function loadFooter() {
    echo '
<footer class="flex-row center-hor center-vert height-20 width-100">
    <p>&copy; 2023. All rights reserved.</p>
</footer>
    ';
}

// red error box custom or based on $e variable which is ?error= in the URL
function callError($e) {
    if ($e === 'wrong_password') {
        $stmt = 'wrong password bro';
    } else if ($e === 'no_user') {
        $stmt = 'wrong username bro';
    } else if ($e === 'registration_failed') {
        $stmt = 'registration failed';
    } else if ($e === 'existing_user') {
        $stmt = 'someone already got that bro';
    } else {
        $stmt = $e;
    }
    echo '
        <div id="error-box" class="flex-row center-hor width-100">
            <h1><i class="fa-solid fa-circle-exclamation error-icon"></i> ' . $stmt . '</h1>
        </div>
    ';
}
function checkLogin() {
    if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
        return true;
    } else {
        header('Location: login.php');
    }
}


// specifically for login.php/register.php
function alreadyLogged() {
    if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
        header('Location: home.php');
    } else {
        return false;
    }
}

// for other functions
function loadID($viewuser, $conn) {
    $query = "SELECT id FROM accounts WHERE username = '$viewuser'";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['id'];
    } else {
        return false;
    }
}
function loadUsername($id, $conn) {
    $query = "SELECT username FROM accounts WHERE id = '$id'";
    $result = $conn->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            return $row['username'];
        }
    } else {
        echo 'no posts';
    }
}

function viewPost() {

}
function loadComments() {

}

// posting
function generatePost($username, $posterID, $message, $likes, $postID) {
    echo '<div class="post width-30">';
    echo '<p>'.$username.'</p>';
    echo '<a href="user.php?viewuser='.$username.'">@'. $username .'</a>';
    echo '<p>'. $message .'</p>';
    echo '<p>'.$postID.'</p>';
        echo '<div class="flex-row">';
            echo '<button class="height-5 width-5" onclick="addLike('.$postID.','. $posterID.')" id="like-btn"><i class="fa-solid fa-heart"></i></button> <p>'. $likes .'</p>';
            echo '<button class="height-5 width-5" onclick="displayCommentBox()" id="comment-btn"><i class="fa-solid fa-comment"></i></button>';
        echo '</div>';
    echo '</div>';
}
function loadPosts() {
    include_once 'db_conn.php';
    $query = "SELECT * FROM posts
              ORDER BY timestamp DESC
              LIMIT 3";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['user_id'];
            $likes = $row['likes'];
            $postID = $row['post_id'];
            $s = loadUsername($id, $conn);
            generatePost($s, $id, $row['content'], $likes, $postID);
        }
    } else {
        echo 'No posts found.';
    }
    $conn->close();
}
function profileLoadPosts() {
    include_once 'db_conn.php';
    $id = $_SESSION['id'];
    $query = "SELECT * FROM posts
              WHERE user_id = '$id'
              ORDER BY timestamp DESC
              LIMIT 25";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        loadAccountInfo($conn, $id);
        while ($row = $result->fetch_assoc()) {
            $id = $row['user_id'];
            $likes = $row['likes'];
            $postID = $row['post_id'];
            $s = loadUsername($id, $conn);
            generatePost($s, $id, $row['content'], $likes, $postID);
        }
    } else {
        echo 'No posts found.';
    }
    $conn->close();
}
function loadAccountInfo($conn, $id) {
    $query = "SELECT username, bio FROM accounts WHERE id = '$id'";
    $result = $conn->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo $row['username'].'<br>';
            echo 'user #'.$id.'<br>';
            echo $row['bio'];
        }
    }
}
function loadViewingPosts($viewuser) {
    include_once 'db_conn.php';
    $viewingID = loadID($viewuser, $conn);
    if ($viewingID !== false) {
        $query = "SELECT * FROM posts WHERE user_id = '$viewingID'";
        $result = $conn->query($query);
        if ($result) {
            loadAccountInfo($conn, $viewingID);
            while ($row = $result->fetch_assoc()) {
                $message = $row['content'];
                $likes = $row['likes'];
                $postID = $row['post_id'];
                generatePost($viewuser, $viewingID, $message, $likes, $postID);
            }
        } else {
            callError('No posts found.');
        }
    } else {
        echo 'User does not exist.';
    }
    $conn->close();
}

