<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $imagePath = ""; // You'll need to handle image uploads separately

    // Insert the package details into your database
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "register";

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $insert_query = "INSERT INTO Packages (Title, Description,  Image_path) VALUES (?,  ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("sss", $title, $description,  $imagePath);

    if ($stmt->execute()) {
        // Package created successfully
        header("Location: package.php"); // Redirect to the packages listing page
        exit();
    } else {
        echo "Error creating package: " . $stmt->error;
    }

    $conn->close();
}
?>
