<?php
if (isset($_GET['package_id'])) {
    $packageID = $_GET['package_id'];

    $host = "localhost"; 
    $username = "root";
    $password = "";
    $database = "register";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch booking details and booking code from the "booked_item" table based on the package ID
    $fetch_booking_query = "SELECT full_name, location, guests, arrivals, leaving, booking_code FROM booked_item WHERE package_id = ?";
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
            $bookingCode = $row['booking_code'];
        } else {
            $fullName = "Full Name Not Found";
            $location = "Location Not Found";
            $guests = "Guests Not Found";
            $arrivals = "Arrival Date Not Found";
            $leaving = "Leaving Date Not Found";
            $bookingCode = "Booking Code Not Found";
        }
    } else {
        echo "Error executing SQL query: " . $stmt->error;
    }

    $conn->close();
} else {
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
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            font-size: 24px;
            color: #333;
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

        strong {
            font-weight: bold;
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
    <div class="container">
        <h1>Thank you for your booking!</h1>
        <ul id="print-container">
            <li><strong>Full Name:</strong> <?php echo $fullName; ?></li>
            <li><strong>Location:</strong> <?php echo $location; ?></li>
            <li><strong>Number of Guests:</strong> <?php echo $guests; ?></li>
            <li><strong>Arrival Date:</strong> <?php echo $arrivals; ?></li>
            <li><strong>Leaving Date:</strong> <?php echo $leaving; ?></li>
            <li><strong>Booking Code:</strong> <?php echo $bookingCode; ?></li>
        </ul>
        <button id="print-button" onclick="printPage()">Print</button>
        <a href="home.php"><strong>Back to the Home Page</strong></a>
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
