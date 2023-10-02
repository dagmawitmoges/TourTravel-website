<?php
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

// Start a new session or resume the existing session
session_start();

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username exists in the database
    $check_query = "SELECT * FROM users WHERE username = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Store user information in the session
            $_SESSION["username"] = $username;
            
            // Set the user's full name in the session
            $_SESSION["user_full_name"] = $row["full_name"];
             // Store user_id in the session
        $_SESSION["user_id"] = $row["id"];
        
            // Redirect to a dashboard or another page after successful login
            
            header('Location: home.html');
            exit; // Important to terminate script execution after redirection
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "Username not found. Please register first.";
    }

    // Close prepared statement
    $check_stmt->close();
}

// Close the database connection
$conn->close();
?>
