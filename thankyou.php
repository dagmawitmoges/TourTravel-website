<?php
function generateUniqueBookingCode($conn) {
    $codeExists = true;
    $bookingCode = "";

    while ($codeExists) {
        $bookingCode = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Check if the generated code already exists in the database
        $check_query = "SELECT COUNT(*) as count FROM book_form WHERE booking_code = ?";
        $stmt_check = $conn->prepare($check_query);
        $stmt_check->bind_param("s", $bookingCode);
        $stmt_check->execute();
        $result = $stmt_check->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count == 0) {
            $codeExists = false; // Unique code generated
        }
    }

    return $bookingCode;
}

$host = "localhost"; 
$username = "root";
$password = "";
$database = "register";

$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the 'register' database if it doesn't exist
$create_database_query = "CREATE DATABASE IF NOT EXISTS register";
if ($conn->query($create_database_query) === TRUE) {
  
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the 'register' database
$conn->select_db($database);

// Create the 'package' table if it doesn't exist
$create_table_query = "CREATE TABLE IF NOT EXISTS package (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL
)";

if ($conn->query($create_table_query) === TRUE) {
   
} else {
    echo "Error creating table: " . $conn->error;
}

if (isset($_GET['package_id'])) {
    $packageID = $_GET['package_id'];

    // Generate booking code
    $bookingCode = generateUniqueBookingCode($conn);

    // Insert the booking code into the 'book_form' table
    $insert_booking_code_query = "UPDATE book_form SET booking_code = ? WHERE id = ?";
    $stmt_insert_code = $conn->prepare($insert_booking_code_query);
    $stmt_insert_code->bind_param("si", $bookingCode, $packageID);
    
    if ($stmt_insert_code->execute()) {
        // Booking code inserted successfully
    } else {
        echo "Error inserting booking code: " . $stmt_insert_code->error;
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
            $fullName = "Full Name Not Found";
            $location = "Location Not Found";
            $guests = "Guests Not Found";
            $arrivals = "Arrival Date Not Found";
            $leaving = "Leaving Date Not Found";
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
