<?php
function generateBookingCode() {
    return str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
}
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
    $bookingCode = generateBookingCode();
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: 'gray';
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 50vh; 
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }
        #print-button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        #print-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class='container' >
    <h1>Thank you for your booking!</h1>
    <p>Your booking details:</p>
    <ul id="print-container">
       
    <li><strong>Full Name:</strong> <?php echo $fullName; ?></li>
            <li><strong>Location:</strong> <?php echo $location; ?></li>
            <li><strong>Number of Guests:</strong> <?php echo $guests; ?></li>
            <li><strong>Arrival Date:</strong> <?php echo $arrivals; ?></li>
            <li><strong>Leaving Date:</strong> <?php echo $leaving; ?></li>
            <li><strong>Booking Code:</strong> <?php echo $bookingCode; ?></li>
    </ul>
    <p><a href="home.html">Return to Home</a></p>
    <button id="print-button" onclick="printPage()">Print</button>
    </div>
    
    <script>
        function printPage() {
            var printContents = document.getElementById("print-container").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

    </script>
</body>
</html>
