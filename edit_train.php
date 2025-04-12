<?php
require("../db/conn.php");

if (!isset($_GET['train_id'])) {
    die("Train ID not specified.");
}

$train_id = $_GET['train_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $train_name = $_POST['train_name'];
    $route = $_POST['route'];

    // Update query
    $updateQuery = "UPDATE trains SET train_name = '$train_name', route = '$route' WHERE train_id = '$train_id'";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: dashboard.php"); // Redirect after update
        exit();
    } else {
        echo "Error updating train: " . mysqli_error($conn);
    }
}

// Fetch the train details
$query = "SELECT * FROM trains WHERE train_id = '$train_id'";
$result = mysqli_query($conn, $query);
$train = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Train</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Train</h2>
        <form method="POST">
            <div class="form-group">
                <label>Train Name</label>
                <input type="text" name="train_name" class="form-control" value="<?= $train['train_name'] ?>" required>
            </div>
            <div class="form-group">
                <label>Route</label>
                <input type="text" name="route" class="form-control" value="<?= $train['route'] ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Update Train</button>
            <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
