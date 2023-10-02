<?php

require_once('session.php');


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

    // Fetch user's full name from the 'users' table based on their ID
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $fetch_full_name_query = "SELECT full_name FROM users WHERE id = ?";
        $stmt = $conn->prepare($fetch_full_name_query);
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $user_full_name = $row['full_name'];
        } else {
            // Handle the error
            $user_full_name = "Unknown User";
        }
    } else {
        // User ID is not set in the session
        $user_full_name = "Unknown User";
    }

    // Insert form data into the database
    $insert_query = "INSERT INTO book_form (full_name, location, guests, arrivals, leaving) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ssiss", $user_full_name, $location, $guests, $arrivals, $leaving);

   // ... (Your existing code for form handling)

if ($stmt->execute()) {
    // Insertion was successful
    $_SESSION['user_id'] = $user_id; // Set the user_id session variable
     $packageID = $stmt->insert_id; 
    header("Location: thankyou.php?package_id=" . $packageID . "&package_title=" . $location . "&package_description=" . $guests);} else {
    // Insertion failed
    echo "Error: " . $stmt->error;
}

$stmt->close();


   
}


?>