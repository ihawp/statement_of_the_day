<?php
include 'db_conn.php';

$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

// Check if username or email already exists
$existingUserQuery = "SELECT * FROM accounts WHERE username = '$username' OR email = '$email'";
$existingUserResult = $conn->query($existingUserQuery);

if ($existingUserResult && $existingUserResult->num_rows > 0) {
    // Redirect back to the registration page with an error message
    header('Location: register.php?error=existing_user');
    exit;
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert the user into the database
$insertQuery = "INSERT INTO accounts (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
$insertResult = $conn->query($insertQuery);

if ($insertResult) {
    $query = "SELECT * FROM accounts WHERE username = '$username'";
    $result = $conn->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
        }
    }
    // Redirect to the login page with a success message
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $id;
    header('Location: home.php');
    exit;
} else {
    // Redirect back to the registration page with an error message
    header('Location: register.php?error=registration_failed');
    exit;
}

$conn->close();
?>
