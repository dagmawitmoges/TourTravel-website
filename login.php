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

   
    if ($username === "dagmawit" && $password === "1234") {

        $_SESSION["username"] = $username;
        $_SESSION["user_full_name"] = "Admin";
        $_SESSION["is_admin"] = true;
        header('Location: Role_admin/admin_dashboard.html');
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
           
            $_SESSION["username"] = $username;
            
           
            $_SESSION["user_full_name"] = $row["full_name"];

            
            $_SESSION["user_id"] = $row["id"];

           
            if ($row["is_admin"] == 1) {
               
                $_SESSION["is_admin"] = true;
                
               
                header('Location:Role_admin/admin_dashboard.html');
            } else {
                
                header('Location: Role_user/home.html');
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
