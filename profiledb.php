<?php
// Fetch user profile information from the 'users' table based on user ID
$user_id = $_SESSION['user_id'];

// Modify the database connection details accordingly
$host = "localhost"; // Your database host
$username = "root";
$password = "";
$database = "register";

// Create a database connection (you should use mysqli or PDO)
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the SQL query to fetch user profile data
$fetch_profile_query = "SELECT full_name, email FROM users WHERE id = ?";
$stmt = $conn->prepare($fetch_profile_query);
$stmt->bind_param("i", $user_id);

// Execute the query
if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Fetch user profile data
        $row = $result->fetch_assoc();
        $full_name = $row['full_name'];
        $email = $row['email'];
    } else {
        // Handle the case where no user data is found
        $full_name = "Full Name Not Found";
        $email = "Email Not Found";
    }
} else {
    // Handle the error
    echo "Error preparing SQL query: " . $stmt->error;
}

// Close the database connection
$stmt->close();
$conn->close();

?>
