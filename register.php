<?php
// Database connection details (modify these with your database credentials)
$host = "localhost";
$username = "root";
$password = "";
$database = "register";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the users table if it doesn't exist
$create_table_query = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL, 
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($create_table_query) === TRUE) {
    echo "Table 'users' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"]; 
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Check if the username is already in use
    $check_query = "SELECT * FROM users WHERE username = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username already exists. Please choose another.";
    } else {
        // Insert user data into the database
        $insert_query = "INSERT INTO users (full_name,email, username, password) VALUES (?, ?, ?,?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("ssss", $full_name,$email, $username, $password);

        if ($insert_stmt->execute()) {
            echo "Registration successful. <a href='login.html'>Login</a>";
        } else {
            echo "Error during registration: " . $conn->error;
        }
    }

    // Close prepared statements
    $check_stmt->close();
    $insert_stmt->close();
}

// Close the database connection
$conn->close();
?>
