<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>

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
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
    <a href="profile.php" class="fas fa-user">  </a>
        
</nav>

<div id="menu-btn" class="fas fa-bars"></div>

</section>

<div class="bookbody" style="background:url(images/header-bg-3.png) no-repeat">
    <div class="heading">
        <h1>Book Now</h1>
    </div>

    <section class="booking">
        <form method="post" action="booking.php" class="book-form">
            
            <div class="flex">
                <div class="inputBox">
                    <span>Full Name</span>
                    <?php
                    session_start();
                   
                    $user_full_name = "";

                    
                    if (isset($_SESSION['user_full_name'])) {
                        $user_full_name = $_SESSION['user_full_name'];
                    }
                    ?>
                    <input type="text" placeholder="Full Name" name="full_name" value="<?php echo $user_full_name; ?>">
                    <span>Package:</span>
                    <?php
                    $location = isset($_GET['package_title']) ? htmlspecialchars($_GET['package_title']) : '';
                    ?>
                    <input type="text" placeholder="Place you want to visit" name="location" value="<?php echo $location; ?>">
                </div>
                <div class="inputBox">
                    <span>How Many:</span>
                    <input type="number" placeholder="Number of guests" name="guests">
                </div>
                <div class="inputBox">
                    <span>Arrival Date:</span>
                    <input  type="date" name="arrivals" required>
                </div>
                <div class="inputBox">
                    <span>Leaving Date:</span>
                    <input type="date" name="leaving">
                </div>
            </div>
            <button type="submit" class="btn">Book</button>
            <h1 class="heading-title">Book Your Trip!</h1>
        </form>
    </section>
</div>

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
