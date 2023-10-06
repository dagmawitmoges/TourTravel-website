<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); 
    exit();
}

$user_id = $_SESSION['user_id'];

$host = "localhost"; 
$username = "root";
$password = "";
$database = "register";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$fetch_profile_query = "SELECT full_name, email FROM users WHERE id = ?";
$stmt = $conn->prepare($fetch_profile_query);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();// Fetch user profile data
        $full_name = $row['full_name'];
        $email = $row['email'];
    } else {
        $full_name = "Full Name Not Found";
        $email = "Email Not Found";
    }
} else {
 
    echo "Error preparing SQL query: " . $stmt->error;
}

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
          
            <span class='icon'>👤</span>
        </div>
        <div class="user-info">
            <h1>User Profile</h1>
            <p>Welcome, <?php echo $full_name; ?>!</p>
            
            <h2>Email:</h2>
            <p> <?php echo $email; ?> </p>
            <form method="post" action="update_profile.php">
    <h2>Edit Profile</h2>
    <label for="new_full_name">Full Name:</label>
    <input type="text" id="new_full_name" name="new_full_name" value="<?php echo $full_name; ?>" required>
    <br>
    <label for="new_email">Email:</label>
    <input type="email" id="new_email" name="new_email" value="<?php echo $email; ?>" required>
    <br>
    <button type="submit">Save Changes</button>
</form>

           
        

           

            <p><a href="logout.php">Logout</a></p> <!-- Provide a logout link to log out the user -->
            <p><a href="home.html">Return to Home</a></p>
        </div>
        
    </div>
</body>
</html>
