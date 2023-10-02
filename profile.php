<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirect to the login page if not logged in
    exit();
}

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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            display: flex;
            max-width: 600px;
        }

        .avatar {
            flex: 0 0 auto;
            width: 150px;
            height: 150px;
            background-color: #007BFF;
            color: #ffffff;
            border-radius: 50%;
            font-size: 48px;
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            margin-right: 8px;
            margin-top: 50px;
            margin-left:10px;
        }

        .avatar img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 50%;
        }

        .user-info {
            flex: 2;
            padding: 20px;
        }

        h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        p {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            transition: color 0.3s;
        }

        a:hover {
            color: #0056b3;
        }

        .logout {
            margin-top: 20px;
        }
    </style>
</head>
<body>
   
    <div class="profile-container">
    <div class="avatar">
            <!-- You can replace this with an actual user avatar -->
            <span class='icon'>👤</span>
        </div>
        <div class="user-info">
            <h1>User Profile</h1>
            <p>Welcome, <?php echo $full_name; ?>!</p>
            
            <h2>Email:</h2>
            <p> <?php echo $email; ?> </p>
            
           
        

           

            <p><a href="logout.php">Logout</a></p> <!-- Provide a logout link to log out the user -->
            <p><a href="home.html">Return to Home</a></p>
        </div>
        
    </div>
</body>
</html>
