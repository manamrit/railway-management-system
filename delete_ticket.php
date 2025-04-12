<?php
require("../db/conn.php");

if (!isset($_GET['ticket_no'])) {
    die("Ticket ID not specified.");
}

$ticket_no = $_GET['ticket_no'];

// Delete query
$query = "DELETE FROM ticketgeneration WHERE ticket_no = '$ticket_no'";
if (mysqli_query($conn, $query)) {
    header("Location: dashboard.php"); // Redirect after deletion
    exit; // Make sure to stop further script execution after redirect
} else {
    echo "Error deleting ticket: " . mysqli_error($conn);
}
?>
