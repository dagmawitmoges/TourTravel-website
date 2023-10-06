<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $imagePath = ""; 

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "register";

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $insert_query = "INSERT INTO Packages (Title, Description, Price, Image_path) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ssds", $title, $description, $price, $imagePath);

    if ($stmt->execute()) {
        header("Location: admin_package.php");
        exit();
    } else {
        echo "Error creating package: " . $stmt->error;
    }

    $conn->close();
}

?>
