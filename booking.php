<?php
// Start a session
session_start();

// Database connection details (modify these with your database credentials)
$host = "localhost";
$username = "root";
$password = "";
$database = "register";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in (assuming you have a login system)
if (isset($_SESSION["username"])) {
    $logged_in_username = $_SESSION["username"];

    // Query the database to fetch the user's full name
    $query = "SELECT full_name FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $logged_in_username);
    $stmt->execute();
    $stmt->bind_result($full_name);

    if ($stmt->fetch()) {
        // Retrieve the full name
        $user_full_name = $full_name;
    }

    // Close the database connection
    $stmt->close();
} else {
    // Handle the case where the user is not logged in or the session variable is not set
    // You can redirect the user to a login page or take appropriate action here
    echo "Please log in to access this page.";
}
?>
