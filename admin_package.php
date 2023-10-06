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
    <script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this package?");
}
</script>

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
    <div class="heading" style="background:url(header-bg-2.png) no-repeat">
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

                    // Display Package Informations
                    echo '<div class="box">';
                    echo '<div class="image">';
                    echo '<img src="' . $imagePath . '" alt="">';
                    echo '</div>';
                    echo '<div class="content">';
                    echo '<h3>' . $title . '</h3>';
                    echo '<p>' . $description . '</p>';
                 
                    
                     echo '<a href="edit_package.php?package_id=' . $row["ID"] . '" class="btn">Edit</a>';
                  
                     echo '<a href="delete_package.php?package_id=' . $row["ID"] . '" class="btn2" onclick="return confirmDelete();">Delete</a>';


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
       
    </section>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
