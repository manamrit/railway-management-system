<?php
require("../db/conn.php");

if (!isset($_GET['uid'])) {
    die("User ID not specified.");
}

$uid = $_GET['uid'];

$query = "DELETE FROM users WHERE uid = '$uid'";
if (mysqli_query($conn, $query)) {
    header("Location: dashboard.php"); // Redirect after deletion
} else {
    echo "Error deleting user: " . mysqli_error($conn);
}
?>
