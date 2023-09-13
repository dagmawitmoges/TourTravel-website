<?php
session_start();
if (isset($_SESSION['user_full_name'])) {
    echo "User Full Name: " . $_SESSION['user_full_name'];
} else {
    echo "User Full Name is not set.";
}
// Database connection details
$host = "localhost"; // Your database host
$username = "root";
$password = "";
$database = "register";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL code to create the "book_form" table
$sql = "CREATE TABLE IF NOT EXISTS book_form (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    guests INT NOT NULL,
    arrivals DATE NOT NULL,
    leaving DATE NOT NULL
)";

// Execute the SQL code to create the table
if ($conn->query($sql) === TRUE) {
    echo "Table 'book_form' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $location = $_POST["location"];
    $guests = $_POST["guests"];
    $arrivals = $_POST["arrivals"];
    $leaving = $_POST["leaving"];

    // Insert form data into the database
    $insert_query = "INSERT INTO book_form (full_name, location, guests, arrivals, leaving) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ssiss", $full_name, $location, $guests, $arrivals, $leaving);

    if ($stmt->execute()) {
        // Insertion was successful
        echo "Booking successful!";
    } else {
        // Insertion failed
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
