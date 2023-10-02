<?php
session_start();

// Check if the admin is not logged in
if (!isset($_SESSION["admin_username"])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h2>Welcome to the Admin Panel</h2>
    <p>Hello, <?php echo $_SESSION["admin_username"]; ?>!</p>
    <p>This is where you can manage your website.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
