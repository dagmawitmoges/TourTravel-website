<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "register";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["package_id"])) {
    $package_id = $_GET["package_id"];

   
    $deleteSql = "DELETE FROM Packages WHERE ID = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $package_id);

    if ($deleteStmt->execute()) {
        echo "Package deleted successfully.";
    } else {
        echo "Error deleting package: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
