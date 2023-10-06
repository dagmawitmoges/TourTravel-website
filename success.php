<?php
session_start();

if (!isset($_SESSION["update_success"]) || $_SESSION["update_success"] !== true) {
   
  echo 'error';
    exit();
}


unset($_SESSION["update_success"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
</head>
<body>
    <h1>Update Successful</h1>
    <p>The package information has been updated successfully.</p>
    <a href="admin_dashboard.php">Back to Admin Dashboard</a>
</body>
</html>
