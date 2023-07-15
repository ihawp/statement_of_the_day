<?php

session_start();

unset($_SESSION['username']);
unset($_SESSION['id']);
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
    header('Location: login.php?successfully_logged_out');
} else {
    echo 'error logging out...? idek bro just go to ihawp.com';
}

