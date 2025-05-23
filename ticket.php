<?php
require ("./db/conn.php");
session_start();

$id = $_GET['id'];
$sql = "SELECT * FROM ticketgeneration WHERE barcode='$id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RailMumbai Ticket</title>
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

			<?php 
				if ($result->num_rows > 0) {	
					while ($row = $result->fetch_assoc()) {
			?>
						<h1 class="text-center my-3">Ticket</h1>
						<div class="jumbotron">
							<div class="row">
								<div class="col-md-12">
									<p class="lead"><b>Ticket Number:</b> <?php echo $row['ticket_no'] ?></p>
									<p class="lead"><b>Source:</b> <?php echo $row['source'] ?></p>
									<p class="lead"><b>Destination:</b> <?php echo $row['destination'] ?></p>
									<p class="lead"><b>Class:</b> <?php echo $row['class'] == '1' ? 'First' : 'Second' ?></p>
									<p class="lead"><b>Type:</b> <?php echo $row['type'] == '1' ? 'Single' : 'Return' ?></p>
									<p class="lead"><b>Booking Time:</b> <?php echo $row['booking_time'] ?></p>
									<p class="lead"><b>Boarding Time:</b> <?php echo $row['boarding_time'] ?></p>
								</div>
							</div>

                            <!-- Print and Download Ticket -->
                            <div class="my-4 text-center">
                                <button onclick="window.print();" class="btn btn-secondary">Print Ticket</button>
                                <a href="ticket_download.php?id=<?php echo $row['ticket_no']; ?>" class="btn btn-primary">Download Ticket</a>
                            </div>
						</div>
			<?php
					}
				} else {
					echo "<h2 class='text-center'>Sorry! Ticket Not Found.</h2>";
				}
			?>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
