<?php
require ('./db/conn.php');
session_start();

if (!isset($_SESSION['uidorPhone'])) {
    header('Location: index.php');
    die("Sorry! You're not logged in.");
}

$queryResult = false;

if ($_POST['source'] && $_POST['type'] && $_POST['number'] && $_POST['via'] && $_POST['destination'] && $_POST['class'] && $_POST['boarding_time']) {
    $source = $_POST['source'];
    $type = $_POST['type'];
    $number = (int)$_POST['number'];
    $via = $_POST['via'];
    $destination = $_POST['destination'];
    $class = (int)$_POST['class'];
    $boardingtime = $_POST['boarding_time'];
    $uid = $_SESSION['uidorPhone'];
    $currentTimeDate = date("Y-m-d H:i:s");
    $currentTimeStamp = strftime("%Y%m%d%H%M%S");
    $uniqueTicketNo = 'RM' . $currentTimeStamp . $_SESSION['uidorPhone'];
    $amount = 10 * $number; // Set your fare logic here

    $sql1 = "INSERT INTO ticketgeneration (ticket_no, uid, source, destination, class, type, no_of_ticket, fare, boarding_time, booking_time, barcode) VALUES ('$uniqueTicketNo','$uid', '$source', '$destination', '$class', '$type', '$number', '$amount', '$boardingtime', '$currentTimeDate', '$uniqueTicketNo')";
    $conn->query($sql1);

    $sql = "INSERT INTO ticketbooking (uid, source, destination, via, class, type, no_of_ticket, fare, boarding_time, booking_time, barcode) VALUES ('$uid', '$source', '$destination', '$via', '$class', '$type', '$number', '$amount', '$boardingtime', '$currentTimeDate', '$uniqueTicketNo')";

    if ($conn->query($sql) === TRUE) {
        $queryResult = true;
    } else {
        $queryResult = false;
    }
} else {
    header('Location: index.php');
    die("Sorry! Please enter all your details properly.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Confirmation</title>
    <link rel="shortcut icon" href="assets/favicon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="loader" id="loader">
        <div class="spinner-border text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div class="d-none" id="main">
        <nav id="navbar" class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">RailMumbai</a>
            </div>
        </nav>

        <div class="container my-2">
            <a href="./index.php" class="btn btn-primary mt-3 d-inline-flex align-items-center justify-content-center">
                <svg width="24" height="24" fill-rule="evenodd" clip-rule="evenodd" fill="#fff"><path d="M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z"/></svg>
                &nbsp;&nbsp;Back
            </a>
            <h1 class="text-center my-3">Ticket</h1>
            <div class="jumbotron text-light <?php echo $queryResult ? 'bg-success' : 'bg-danger' ?>">
                <div class="text-center">
                    <img class="mx-auto" src="<?php echo $queryResult ? './assets/success.gif' : './assets/fail.gif' ?>" alt="">
                    <h2 class="mt-4">
                        <?php echo $queryResult ? 'Ticket Booking Success' : 'Ticket Booking Failed' ?>
                    </h2>
                </div>
                <?php if ($queryResult): ?>
                <div class="my-2 text-center">
                    <a href="ticket.php?id=<?php echo $uniqueTicketNo ?>" class="btn btn-primary mt-4">Show Ticket</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
