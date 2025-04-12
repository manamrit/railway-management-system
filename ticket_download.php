<?php
require('./db/conn.php');

// Check if the ticket ID is provided
if (!isset($_GET['id'])) {
    die("Ticket ID not specified.");
}

$ticket_no = $_GET['id'];

// Fetch the ticket details from the database
$query = "SELECT * FROM ticketgeneration WHERE ticket_no = '$ticket_no'";
$result = mysqli_query($conn, $query);
$ticket = mysqli_fetch_assoc($result);

// Check if ticket is found
if (!$ticket) {
    die("Ticket not found.");
}

// Set the file name for download
$file_name = "ticket_" . $ticket['ticket_no'] . ".txt";

// Content of the ticket
$ticket_content = "Ticket Number: " . $ticket['ticket_no'] . "\n";
$ticket_content .= "Source: " . $ticket['source'] . "\n";
$ticket_content .= "Destination: " . $ticket['destination'] . "\n";
$ticket_content .= "Class: " . ($ticket['class'] == '1' ? 'First' : 'Second') . "\n";
$ticket_content .= "Type: " . ($ticket['type'] == '1' ? 'Single' : 'Return') . "\n";
$ticket_content .= "Booking Time: " . $ticket['booking_time'] . "\n";
$ticket_content .= "Boarding Time: " . $ticket['boarding_time'] . "\n";

// Set headers to trigger file download
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="' . $file_name . '"');
header('Content-Length: ' . strlen($ticket_content));

// Output the ticket content
echo $ticket_content;
exit;
