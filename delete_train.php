<?php
require("../db/conn.php");

if (!isset($_GET['train_id'])) {
    die("Train ID not specified.");
}

$train_id = $_GET['train_id'];

// Delete query
$query = "DELETE FROM trains WHERE train_id = '$train_id'";
if (mysqli_query($conn, $query)) {
    header("Location: dashboard.php"); // Redirect after deletion
} else {
    echo "Error deleting train: " . mysqli_error($conn);
}
?>
