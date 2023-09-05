<?php
// Start a session
session_start();

// Database connection details (modify these with your database credentials)
$host = "localhost";
$username = "root";
$password = "";
$database = "register";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Define the SQL query to create the "users" table
$create_table_query = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL
)";

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Execute the query to create the table
if ($conn->query($create_table_query) === TRUE) {
    echo "Table 'users' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Rest of your code (session handling, form processing, etc.)

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<section class="header">

        <a href="home.html" class="logo">travel.</a>

        <nav class="navbar">
            <a href="home.html">home</a>
            <a href="about.html">about</a>
            <a href="package.html">package</a>
            <a href="book.html">book</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>

    <div class="bookbody" style="background:url(images/gift-habeshaw--C5cJ41YPDg-unsplash.jpg) no-repeat">
        <div class="heading">
            <h1>book now</h1>
        </div>

        

        <section class="booking">

         
            <form   method="post" class="book-form">

                <div class="flex">
                    <div class="inputBox">
                        <span>Full Name</span>
                       
                        <input type="text" placeholder="Full Name" name="full_name" value="<?php echo isset($user_full_name) ? $user_full_name : ''; ?>" readonly>
                        <span>where to :</span>
                        <input type="text" placeholder="place you want to visit" name="location">
                    </div>
                    <div class="inputBox">
                        <span>how many :</span>
                        <input type="number" placeholder="number of guests" name="guests">
                    </div>
                    <div class="inputBox">
                        <span>arrivals :</span>
                        <input type="date" name="arrivals">
                    </div>
                    <div class="inputBox">
                        <span>leaving :</span>
                        <input type="date" name="leaving">
                    </div>
                </div>

                <button  type="submit" > <a href="thankyou.html" >
                    
                 book</button></a>
<!-- 
                <input type="submit" value="Book" class="btn" name="send"> -->
              <h1 class="heading-title">book your trip!
            </form>
  


    </section>
 
  
















<!-- footer -->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>quick links</h3>
                <a href="home.html"> <i class="fas fa-angle-right"></i> home</a>
                <a href="about.html"> <i class="fas fa-angle-right"></i> about</a>
                <a href="package.html"> <i class="fas fa-angle-right"></i> package</a>
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
                <a href="#"> <i class="fas fa-envelope"></i> dagmawitmogesali@gmail.com </a>
                <a href="#"> <i class="fas fa-map"></i> addisababa, ethiopia - 400104 </a>
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
                <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
                <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
                <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
            </div>

        </div>

        <div class="credit"> ጫካ  <span></span> የጉዞ ወኪል </div>

    </section>










    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>


    <script src="js/script.js"></script>

</body>

</html>