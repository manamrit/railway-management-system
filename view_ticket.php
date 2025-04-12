<?php
require("../db/conn.php");

if (!isset($_GET['ticket_no'])) {
    die("Ticket ID not specified.");
}

$ticket_no = $_GET['ticket_no'];

// Fetch ticket details
$query = "SELECT * FROM ticketgeneration WHERE ticket_no = '$ticket_no'";
$result = mysqli_query($conn, $query);
$ticket = mysqli_fetch_assoc($result);

if (!$ticket) {
    die("Ticket not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Ticket</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Ticket Details</h2>
        <table class="table">
            <tr>
                <th>Ticket ID</th>
                <td><?php echo htmlspecialchars($ticket['ticket_no']); ?></td>
            </tr>
            <tr>
                <th>Source</th>
                <td><?php echo htmlspecialchars($ticket['source']); ?></td>
            </tr>
            <tr>
                <th>Destination</th>
                <td><?php echo htmlspecialchars($ticket['destination']); ?></td>
            </tr>
            <tr>
                <th>Class</th>
                <td><?php echo htmlspecialchars($ticket['class']); ?></td>
            </tr>
            <tr>
                <th>Type</th>
                <td><?php echo htmlspecialchars($ticket['type']); ?></td>
            </tr>
            <tr>
                <th>Fare</th>
                <td><?php echo htmlspecialchars($ticket['fare']); ?></td>
            </tr>
            <tr>
                <th>Booking Time</th>
                <td><?php echo htmlspecialchars($ticket['booking_time']); ?></td>
            </tr>
            <tr>
                <th>Boarding Time</th>
                <td><?php echo htmlspecialchars($ticket['boarding_time']); ?></td>
            </tr>
            <tr>
                <th>Barcode</th>
                <td><?php echo htmlspecialchars($ticket['barcode']); ?></td>
            </tr>
        </table>
        <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</body>
</html>
