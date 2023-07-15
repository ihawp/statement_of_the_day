<?php

$servername = "localhost";
$usernamejskhdfjsdklhfjsdkhfs = "root";
$passwordasdasdsadsadsa = "";
$dbname = "mypersonal";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $usernamejskhdfjsdklhfjsdkhfs, $passwordasdasdsadsadsa, $dbname, $port);


if ($conn->connect_error) {
    echo 'connection error', $conn->connect_error;
}