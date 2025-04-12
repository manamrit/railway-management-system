<?php
require("../db/conn.php");

if (!isset($_GET['uid'])) {
    die("User ID not specified.");
}

$uid = $_GET['uid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone = $_POST['phone'];

    $updateQuery = "UPDATE users SET phone = '$phone' WHERE uid = '$uid'";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: dashboard.php"); // Redirect after update
        exit();
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
}

// Fetch user data to pre-fill the form
$query = "SELECT * FROM users WHERE uid = '$uid'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit User</h2>
    <form method="POST">
        <div class="form-group">
            <label>UID</label>
            <input type="text" class="form-control" value="<?= $user['uid'] ?>" disabled>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
