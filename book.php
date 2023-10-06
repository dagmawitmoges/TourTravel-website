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
    <a href="home.php" class="logo">travel.</a>
    <nav class="navbar">
        <a href="home.php">home</a>
        <a href="about.html">about</a>
        <a href="package.php">package</a>
        <a href="book.php">book</a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</section>

<div class="bookbody" style="background:url(images/gift-habeshaw--C5cJ41YPDg-unsplash.jpg) no-repeat">
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
                    // Initialize the $user_full_name variable
                    $user_full_name = "";

                    // Check if the user is logged in and has a full name in the session
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
                    
                    <!-- Add the input field for the price -->
                    <span>Price:</span>
                    <?php
                    $price = isset($_GET['package_price']) ? htmlspecialchars($_GET['package_price']) : '';
                    ?>
<input type="text" placeholder="Price" name="price" value="<?php echo $price; ?>">
                </div>
                <div class="inputBox">
                    <span>How Many:</span>
                    <input type="number" placeholder="Number of guests" name="guests">
                </div>
                <div class="inputBox">
                    <span>Arrival Date:</span>
                    <input  type="date" name="arrivals" required>
                </div>
                <div class="inputBox" required>
                    <span>Leaving Date:</span>
                    <input type="date" name="leaving">
                </div>
            </div>
            <button type="submit">Book</button>
            <h1 class="heading-title">Book Your Trip!</h1>
        </form>
    </section>
</div>

<section class="footer">
</section>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>

</html>
