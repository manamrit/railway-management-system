<?php
	require ("../db/conn.php");
	session_start();

	// Clear any existing session before starting a new one
	if (isset($_SESSION['adminUidorPhone'])) {
		unset($_SESSION['adminUidorPhone']);
		session_destroy(); // Destroy any active session
	}

	// If admin is already logged in, redirect them to dashboard
	if (isset($_SESSION['adminUidorPhone'])) {
		header("Location: dashboard.php");
		die();
	}

	// Check if form is submitted
	if (isset($_POST['adminUidorPhone']) && isset($_POST['password'])) {
		$adminUidorPhone = stripslashes($_POST['adminUidorPhone']);
		$adminUidorPhone = mysqli_real_escape_string($conn, $adminUidorPhone); 
		$password = stripslashes($_POST['password']);
		$password = mysqli_real_escape_string($conn, $password);
		$password = md5($password); // Hash password

		// Query to check if the credentials are valid
		$query = "SELECT * FROM `admin` WHERE password='$password' AND (uid='$adminUidorPhone' OR phone='$adminUidorPhone')";
		$result = mysqli_query($conn, $query);

		if ($result) {
			$rows = mysqli_num_rows($result);

			// If login is successful
			if ($rows == 1) {
				// Set session variable
				$_SESSION['adminUidorPhone'] = $adminUidorPhone;
				// Redirect to admin dashboard
				header("Location: dashboard.php");
				die();
			} else {
				// Show error message if credentials are incorrect
				$error_message = "Invalid credentials!";
			}
		} else {
			// Query failed
			$error_message = "Error while querying the database.";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RailMumbai Admin LogIn</title>
	<link rel="shortcut icon" href="../assets/favicon.png">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
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
			<h1>Admin LogIn</h1>
		</div>

		<form action=<?php echo $_SERVER["PHP_SELF"]; ?> method="POST">
			<div class="container">
				<?php
				if (isset($error_message)) {
					echo "<div class='alert alert-danger' role='alert'>" . $error_message . "</div>";
				}
				?>
				<div class="input-group flex-nowrap my-4">
					<div class="input-group-prepend">
						<span class="input-group-text">🆔</span>
					</div>
					<input type="text" name="adminUidorPhone" class="form-control" placeholder="UID or Phone" required>
				</div>
				<div class="input-group flex-nowrap my-4">	
					<div class="input-group-prepend">
						<span class="input-group-text">🔒</span>
					</div>
					<input type="password" name="password" class="form-control" placeholder="Password" required>
				</div>
				<div class="mb-3">
					<p class="text-muted">Don't have an account yet? Ask your seniors.</p>
				</div>
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</form>
	</div>

	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/main.js"></script>
</body>
</html>
