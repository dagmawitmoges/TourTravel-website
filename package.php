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

<a href="home.html" class="logo">ጫካ </a>

<nav class="navbar">
    <a href="home.html">home</a>
    <a href="about.html">about</a>
    <a href="package.php">package</a>
    <a href="book.php">book</a>
    <a href="login.html">signin</a>
    <a href="profile.php" class="fas fa-user">  </a>
        
</nav>

<div id="menu-btn" class="fas fa-bars"></div>

</section>
    <div  class="heading" style="background:url(images/header-bg-2.png) no-repeat">
        <h1>packages</h1>
    </div>
    <section class="packages">
        <h1 class="heading-title">Top Destinations</h1>
        <div class="box-container">
            <?php
            $hostname = "localhost";
            $username = "root";
            $password = "";
            $database = "register";

            $conn = new mysqli($hostname, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection Failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM Packages";
            $result = $conn->query($sql);

            if (!$result) {
                die("Query failed: " . $conn->error);
            }

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                   
                    $title = $row["Title"];
                    $description = $row["Description"];
                    $imagePath = $row["Image_path"];

                   
                    echo '<div class="box">';
                    echo '<div class="image">';
                    echo '<img src="' . $imagePath . '" alt="">';
                    echo '</div>';
                    echo '<div class="content">';
                    echo '<h3>' . $title . '</h3>';
                    echo '<p>' . $description . '</p>';
                    echo '<p>Price: $' . number_format($row["Price"], 2) . '</p>'; 
                    echo '<a href="book.php?package_title=' . urlencode($title)  . '" class="btn">Book Now</a>';
                    
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No packages found.";
            }

            $conn->close();
            ?>
        </div>
    </section>
    <section class="footer">

<div class="box-container">

    <div class="box">
        <h3>quick links</h3>
        <a href="home.html"> <i class="fas fa-angle-right"></i> home</a>
        <a href="about.html"> <i class="fas fa-angle-right"></i> about</a>
        <a href="package.php"> <i class="fas fa-angle-right"></i> package</a>
        <a href="book.html"> <i class="fas fa-angle-right"></i> book</a>
    </div>

    <div class="box">
        <h3>extra links</h3>
        <a href="#"> <i class="fas fa-angle-right"></i> ask questions</a>
        <a href="#"> <i class="fas fa-angle-right"></i> about us</a>
        <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
        <a href="#"> <i class="fas fa-angle-right"></i> terms of use</a>
    </div>

    <div class="box">
        <h3>contact info</h3>
        <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a>
        <a href="#"> <i class="fas fa-phone"></i> +111-222-3333 </a>
        <a href="#"> <i class="fas fa-envelope"></i> shaikhanas@gmail.com </a>
        <a href="#"> <i class="fas fa-map"></i> mumbai, india - 400104 </a>
    </div>

    <div class="box">
        <h3>follow us</h3>
        <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
        <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
        <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
        <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
    </div>

</div>

<div class="credit"> created by <span>ጫካ  የጉዞ ወኪል </span>  </div>

</section>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
