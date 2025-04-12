<?php
session_start();

// Check if admin session exists
if (isset($_SESSION['admin_id'])) {
    // Clear the session
    session_unset();
    session_destroy();
    // Redirect to user.php in the root directory
    header("Location: ../user.php");  // Relative path to go to the root
    exit;
} else {
    // If no admin session exists, redirect to user page (optional)
    header("Location: ../user.php");  // Relative path to go to the root
    exit;
}
?>
