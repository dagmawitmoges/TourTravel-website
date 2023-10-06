<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "register";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$createTableQuery = "CREATE TABLE IF NOT EXISTS Packages (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255) NOT NULL,
    Description TEXT,
    Price DECIMAL(10, 2),
    Image_path VARCHAR(255)
)";

$sql = "SELECT * FROM Packages";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <section class="header">
        <a href="home.php" class="logo">Chaka tour and travel.</a>
        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="about.html">about</a>
            <a href="package.php">package</a>
            <a href="book.php">book</a> 
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </section>
    <div class="heading" style="background:url(images/header-bg-.png) no-repeat">
        <h1>packages</h1>
    </div>
    <section class="packages">
        <h1 class="heading-title">Top Destinations</h1>
        <div class="box-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $title = $row["Title"];
                    $description = $row["Description"];
                    $imagePath = $row["Image_path"];

                    // Check if "Price" key exists
                    $price = isset($row["Price"]) ? $row["Price"] : 0.00;

                    // Display Package Information
                    echo '<div class="box">';
                    echo '<div class="image">';
                    echo '<img src="' . $imagePath . '" alt="">';
                    echo '</div>';
                    echo '<div class="content">';
                    echo '<h3>' . $title . '</h3>';
                    echo '<p>' . $description . '</p>';
                    echo '<p><strong>Price:</strong> $' . number_format($price, 2) . '</p>';
                    echo '<a href="book.php?package_title=' . urlencode($title) . '&price=' . urlencode($price) . '" class="btn">Book Now</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No packages found.";
            }

            $conn->close();
            ?>
        </div>
        <div class="load-more"><span class="btn">Load More</span></div>
    </section>
    <section class="footer">
        <!-- Footer section -->
        <div class="box-container">
        </div>
        <div class="credit"> Created by <span>ጫካ  የጉዞ ወኪል.</span></div>
    </section>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
