<?php

include 'db_conn.php';
session_start();

// Define the target directory to store uploaded files
$targetDirectory = 'uploads/';

// Define allowed file types
$allowedFileTypes = ['jpg', 'jpeg', 'png'];

// Retrieve the uploaded file details
$uploadedFileName = $_FILES['profile_picture']['name'];
$uploadedFileType = $_FILES['profile_picture']['type'];
$uploadedFileSize = $_FILES['profile_picture']['size'];

// Generate a unique filename to avoid conflicts
$user_id = $_SESSION['id'];
$uniqueFilename = $user_id . '_' . time() . '_' . $uploadedFileName;
$uploadedFilePath = $targetDirectory . basename($uniqueFilename);

// Check if the uploaded file has an allowed file type
$fileExtension = strtolower(pathinfo($uploadedFileName, PATHINFO_EXTENSION));
if (!in_array($fileExtension, $allowedFileTypes)) {
    header('Location: settings.php?error=Only JPG, JPEG, and PNG file types are allowed.');
    exit;
}

// Check if the file size is within the allowed limit (e.g., 2MB)
$maxFileSize = 2 * 1024 * 1024; // 2MB in bytes
if ($uploadedFileSize > $maxFileSize) {
    header('Location: settings.php?error=File size exceeds the allowed limit.');
    exit;
}

// Move the uploaded file to the target directory with the unique filename
if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadedFilePath)) {
    // File uploaded successfully, you can now insert the file details into the database

    // Get the previous profile picture path from the 'accounts' table
    $previousPfpSql = "SELECT pfp FROM accounts WHERE id = ?";
    $previousPfpStmt = $conn->prepare($previousPfpSql);
    $previousPfpStmt->bind_param("i", $user_id);
    $previousPfpStmt->execute();
    $previousPfpStmt->bind_result($previousPfpPath);
    $previousPfpStmt->fetch();
    $previousPfpStmt->close();

    // Delete the previous profile picture file from the 'uploads' folder if it exists
    if ($previousPfpPath && file_exists($previousPfpPath)) {
        $previousPfpFile = basename($previousPfpPath);
        $previousPfpFilePath = $targetDirectory . $previousPfpFile;
        if (file_exists($previousPfpFilePath)) {
            unlink($previousPfpFilePath);
        }
    }

    // Prepare the SQL statement to insert the file details into the database
    $sql = "INSERT INTO image_upload (name, type, size, path, user_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $uploadedFileName, $uploadedFileType, $uploadedFileSize, $uploadedFilePath, $user_id);
    $stmt->execute();

    // Update the 'pfp' column in the 'accounts' table
    $updateSql = "UPDATE accounts SET pfp = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("si", $uploadedFilePath, $user_id);
    $updateStmt->execute();

    // Close the database connections
    $stmt->close();
    $updateStmt->close();
    $conn->close();

    header('Location: settings.php?success=PFP uploaded successfully');

} else {
    header('Location: settings.php?error=Failed to upload the file.');

}
?>
