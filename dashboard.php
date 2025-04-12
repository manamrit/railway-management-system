<?php
	require ("../db/conn.php");
	session_start();

	if (!isset($_SESSION['adminUidorPhone'])) {
		header("Location: index.php");
		die();
	}

	// Fetch users
	$query = "SELECT * FROM `users`";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Error fetching user data: " . mysqli_error($conn));
	}
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// Fetch trains
	$trainQuery = "SELECT * FROM `trains`";
	$trainResult = mysqli_query($conn, $trainQuery);
	if (!$trainResult) {
		die("Error fetching train data: " . mysqli_error($conn));
	}
	$trains = mysqli_fetch_all($trainResult, MYSQLI_ASSOC);

	// Fetch tickets from ticketgeneration
	$ticketQuery = "SELECT * FROM `ticketgeneration`";
	$ticketResult = mysqli_query($conn, $ticketQuery);
	if (!$ticketResult) {
		die("Error fetching ticket data: " . mysqli_error($conn));
	}
	$tickets = mysqli_fetch_all($ticketResult, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<style>
		.card { margin-bottom: 30px; }
		.table th, .table td { text-align: center; }
		.btn-custom { background-color: #28a745; color: white; }
		.btn-custom:hover { background-color: #218838; }
		.navbar { background-color: #333; }
		.navbar a { color: white; }
		.navbar a:hover { color: #ccc; }
	</style>
</head>
<body>
	<div class="container my-4">
		<nav class="navbar navbar-expand-lg navbar-dark">
			<div class="container">
				<a class="navbar-brand" href="dashboard.php">RailMumbai Admin</a>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a class="nav-link" href="admin_logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>

		<h1 class="my-4">Welcome to Admin Dashboard</h1>
		<p class="lead">Manage Users, Trains, and Bookings efficiently</p>

		<!-- User Management -->
		<div class="card">
			<div class="card-header"><h3>User Management</h3></div>
			<div class="card-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr><th>UID</th><th>Phone</th><th>Registration Date</th><th>Actions</th></tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user): ?>
							<tr>
								<td><?= htmlspecialchars($user['uid']) ?></td>
								<td><?= htmlspecialchars($user['phone']) ?></td>
								<td><?= htmlspecialchars($user['trn_date']) ?></td>
								<td>
									<a href="edit_user.php?uid=<?= $user['uid'] ?>" class="btn btn-warning btn-custom">Edit</a>
									<a href="delete_user.php?uid=<?= $user['uid'] ?>" class="btn btn-danger btn-custom">Delete</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Train Management -->
		<div class="card">
			<div class="card-header"><h3>Train Management</h3></div>
			<div class="card-body">
				<a href="add_train.php" class="btn btn-primary mb-3 btn-custom">Add New Train</a>
				<table class="table table-bordered table-striped">
					<thead>
						<tr><th>Train ID</th><th>Train Name</th><th>Route</th><th>Actions</th></tr>
					</thead>
					<tbody>
						<?php foreach ($trains as $train): ?>
							<tr>
								<td><?= htmlspecialchars($train['train_id']) ?></td>
								<td><?= htmlspecialchars($train['train_name']) ?></td>
								<td><?= htmlspecialchars($train['route']) ?></td>
								<td>
									<a href="edit_train.php?train_id=<?= $train['train_id'] ?>" class="btn btn-warning btn-custom">Edit</a>
									<a href="delete_train.php?train_id=<?= $train['train_id'] ?>" class="btn btn-danger btn-custom">Delete</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Ticket Management -->
		<div class="card">
			<div class="card-header"><h3>Ticket Management</h3></div>
			<div class="card-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Ticket No</th>
							<th>User ID</th>
							<th>Source</th>
							<th>Destination</th>
							<th>Class</th>
							<th>No. of Tickets</th>
							<th>Fare</th>
							<th>Booking Time</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($tickets as $ticket): ?>
							<tr>
								<td><?= htmlspecialchars($ticket['ticket_no']) ?></td>
								<td><?= htmlspecialchars($ticket['uid']) ?></td>
								<td><?= htmlspecialchars($ticket['source']) ?></td>
								<td><?= htmlspecialchars($ticket['destination']) ?></td>
								<td><?= htmlspecialchars($ticket['class']) ?></td>
								<td><?= htmlspecialchars($ticket['no_of_ticket']) ?></td>
								<td>₹<?= htmlspecialchars($ticket['fare']) ?></td>
								<td><?= htmlspecialchars($ticket['booking_time']) ?></td>
								<td>
									<a href="view_ticket.php?ticket_no=<?= $ticket['ticket_no'] ?>" class="btn btn-info btn-custom">View</a>
									<a href="delete_ticket.php?ticket_no=<?= $ticket['ticket_no'] ?>" class="btn btn-danger btn-custom">Delete</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>
