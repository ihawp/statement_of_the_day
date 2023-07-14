<?php

session_start();

$servername = "localhost";
$user = "root";
$password = "";
$dbname = "mypersonal";

// Create connection
$conn = new mysqli($servername, $user, $password, $dbname);


if ($conn->connect_error) {
    echo 'connection error', $conn->connect_error;
}