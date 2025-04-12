<?php
require("../db/conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $train_name = $_POST['train_name'];
    $route = $_POST['route'];

    // Insert query
    $insertQuery = "INSERT INTO trains (train_name, route) VALUES ('$train_name', '$route')";
    if (mysqli_query($conn, $insertQuery)) {
        header("Location: dashboard.php"); // Redirect after adding
        exit();
    } else {
        echo "Error adding train: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add New Train</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Train</h2>
        <form method="POST">
            <div class="form-group">
                <label>Train Name</label>
                <input type="text" name="train_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Route</label>
                <input type="text" name="route" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Train</button>
            <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
