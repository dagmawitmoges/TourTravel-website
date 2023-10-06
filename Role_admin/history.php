<?php
require_once('session.php');

if (isset($_SESSION['user_full_name'])) {
   
} else {
    echo "User Full Name is not set.";
}
$host = "localhost";
$username = "root";
$password = "";
$database = "register";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS book_form (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    guests INT NOT NULL,
    arrivals DATE NOT NULL,
    leaving DATE NOT NULL
)";

if ($conn->query($sql) === TRUE) {
   
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}


$select_query = "SELECT * FROM book_form";
$result = $conn->query($select_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Booking Data</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 30px auto;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            font-size: 18px;
        }
        
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        h1{
            text-align: center ;
            font-size: 40px;
        }
    </style>

</head>
<body>
<section class="header">

        <a href="admin_dashboard.html" class="logo">ጫካ </a>

        <nav class="navbar">
            <a href="admin_dashboard.html">home</a>
            <a href="admin_about.html">about</a>
            <a href="admin_package.php">package</a>
            
           
            <a href="history.php"> <i class="fas fa-angle-right"></i> History</a>
            <a href="Create_package.html"> <i class="fas fa-angle-right"></i> Settings</a>
            <a href="../Role_user/logout.html"><i class="fas fa-sign-out-alt"></i></a>
            <a href="../Role_user/profile.php" class="fas fa-user">  </a>

                
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>
    <h1>Booking Data</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>User Full Name</th>
            <th>Location</th>
            <th>Guests</th>
            <th>Arrivals</th>
            <th>Leaving</th>
            <th>Booking Code</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["full_name"] . "</td>";
                echo "<td>" . $row["location"] . "</td>";
                echo "<td>" . $row["guests"] . "</td>";
                echo "<td>" . $row["arrivals"] . "</td>";
                echo "<td>" . $row["leaving"] . "</td>";
                echo "<td>" . $row["booking_code"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found in the 'book_form' table.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
