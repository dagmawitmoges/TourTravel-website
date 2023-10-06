<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["Title"];
    $description = $_POST["Description"];
    // $package_price = $_POST["package_price"];
  
    
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "register";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $update_query = "UPDATE packages SET Description=?WHERE Title=?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sss", $description, $package_price, $title);

    if ($update_stmt->execute()) {
        // Update successful, you can redirect to a success page
        header("Location: success.php");
        exit();
    } else {
        echo "Error updating package: " . $update_stmt->error;
    }

    $update_stmt->close();
    $conn->close();
}
?>
