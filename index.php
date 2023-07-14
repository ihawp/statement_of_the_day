<?php



if ($_SESSION['cookies_accepted']) {
    header('Location: login.php');
} else {
    header('Location: register.php');
}