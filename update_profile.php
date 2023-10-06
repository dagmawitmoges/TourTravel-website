<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); 
    exit();
}

$user_id = $_SESSION['user_id'];

$host = "localhost"; 
$username = "root";
$password = "";
$database = "register";

try {
    
    $conn = new mysqli($host, $username, $password, $database);
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_full_name = htmlspecialchars($_POST["new_full_name"]); // Escape user input
        $new_email = htmlspecialchars($_POST["new_email"]); // Escape user input

       
        $update_query = "UPDATE users SET full_name = ?, email = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ssi", $new_full_name, $new_email, $user_id);

        if ($update_stmt->execute()) {
           
            echo "<script>alert('Successfully Changed');</script>";
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating profile: " . $conn->error;
        }

        
        $update_stmt->close();
    }
    
    $conn->close();
} catch (mysqli_sql_exception $e) {
    echo "Database error: " . $e->getMessage();
}
?>
