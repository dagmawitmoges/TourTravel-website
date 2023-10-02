<?php
// Check if the package ID is passed in the URL
if (isset($_GET['package_id'])) {
    $packageID = $_GET['package_id'];

    // Database connection details
    $host = "localhost"; // Your database host
    $username = "root";
    $password = "";
    $database = "register";

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch booking details from the 'book_form' table based on the package ID
    $fetch_booking_query = "SELECT full_name, location, guests, arrivals, leaving FROM book_form WHERE id = ?";
    $stmt = $conn->prepare($fetch_booking_query);
    $stmt->bind_param("i", $packageID);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fullName = $row['full_name'];
            $location = $row['location'];
            $guests = $row['guests'];
            $arrivals = $row['arrivals'];
            $leaving = $row['leaving'];
        } else {
            // No booking data found
            $fullName = "Full Name Not Found";
            $location = "Location Not Found";
            $guests = "Guests Not Found";
            $arrivals = "Arrival Date Not Found";
            $leaving = "Leaving Date Not Found";
        }
    } else {
        // Handle the error
        echo "Error executing SQL query: " . $stmt->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Package ID is missing
    echo "Package ID is missing.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
</head>
<body>
    <h1>Thank you for your booking!</h1>
    <p>Your booking details:</p>
    <ul>
        <li>Package Title: <?php echo $packageTitle; ?></li>
        <li>Package Description: <?php echo $packageDescription; ?></li>
        <li>Full Name: <?php echo $fullName; ?></li>
        <li>Location: <?php echo $location; ?></li>
        <li>Number of Guests: <?php echo $guests; ?></li>
        <li>Arrival Date: <?php echo $arrivals; ?></li>
        <li>Leaving Date: <?php echo $leaving; ?></li>
    </ul>
    <p><a href="home.html">Return to Home</a></p>
</body>
</html>
