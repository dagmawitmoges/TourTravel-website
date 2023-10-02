<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "register";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

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
        
            
            header('Location: home.html');
            exit; 
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "Username not found. Please register first.";
    }

    $check_stmt->close();
}

$conn->close();
?>
