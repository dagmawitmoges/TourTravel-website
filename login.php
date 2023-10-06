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

    // Check if the username and password are for the admin
    if ($username === "dagmawit" && $password === "1234") {
        // Redirect the admin to the admin page
        $_SESSION["username"] = $username;
        $_SESSION["user_full_name"] = "Admin"; // Set admin's full name
        $_SESSION["is_admin"] = true;
        header('Location: admin_dashboard.html');
        exit;
    }

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

            // Check if the user is an admin (you should have an 'is_admin' column in your 'users' table)
            if ($row["is_admin"] == 1) {
                // Mark the user as an admin in the session
                $_SESSION["is_admin"] = true;
                
                // Redirect the admin to the admin page
                header('Location:admin/admin.php');
            } else {
                // Redirect regular users to the home page
                header('Location: home.php');
            }
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
