<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location:profile.php"); 
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
        
        $row = $result->fetch_assoc();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/profile.css">

    <title>User Profile</title>
    
</head>
<body>
<section class="header">

<a href="home.html" class="logo">ጫካ </a>

<nav class="navbar">
    <a href="home.html">home</a>
    <a href="about.html">about</a>
    <a href="package.php">package</a>
    <a href="book.php">book</a>
 <a href="profile.php" class="fas fa-user">  </a>        
</nav>

<div id="menu-btn" class="fas fa-bars"></div>

</section>
   
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

           
        

           

            <p><a href="logout.php">Logout</a></p> 
            <p><a href="home.html">Return to Home</a></p>
        </div>
        
    </div>
</body>
</html>