<?php
require_once('session.php');

if (isset($_SESSION['user_full_name'])) {
    echo "User Full Name: " . $_SESSION['user_full_name'];
} else {
    echo "User Full Name is not set.";
}

$host = "localhost";
$username = "root";
$password = "";
$database = "register";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the "booked_item" table if it doesn't exist
$create_booked_item_table_sql = "CREATE TABLE IF NOT EXISTS booked_item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    package_id INT NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    guests INT NOT NULL,
    arrivals DATE NOT NULL,
    leaving DATE NOT NULL,
    booking_code VARCHAR(4) NOT NULL
)";

if ($conn->query($create_booked_item_table_sql) === TRUE) {
    echo "Table 'booked_item' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $location = $_POST["location"];
    $guests = $_POST["guests"];
    $arrivals = $_POST["arrivals"];
    $leaving = $_POST["leaving"];
    $price = $_POST["price"]; // Retrieve the price from the form

    // Fetch user's full name from the users table based on their ID
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $fetch_full_name_query = "SELECT full_name FROM users WHERE id = ?";
        $stmt = $conn->prepare($fetch_full_name_query);
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $user_full_name = $row['full_name'];
        } else {
            $user_full_name = "Unknown User";
        }
    } else {
        $user_full_name = "Unknown User";
    }

    // Generate a unique 4-digit booking code
    function generateUniqueBookingCode($conn) {
        $codeExists = true;
        $bookingCode = "";

        while ($codeExists) {
            $bookingCode = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

            // Check if the generated code already exists in the database
            $check_query = "SELECT COUNT(*) as count FROM booked_item WHERE booking_code = ?";
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

    $bookingCode = generateUniqueBookingCode($conn);

    $insert_query = "INSERT INTO booked_item (user_id, full_name, location, guests, arrivals, leaving, booking_code) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("issssss", $user_id, $full_name, $location, $guests, $arrivals, $leaving, $bookingCode);

    if ($stmt->execute()) {
        $packageID = $stmt->insert_id;

        // Store the booking details in the "booked_item" table
        $insert_booking_query = "INSERT INTO booked_item (user_id, package_id, full_name, location, guests, arrivals, leaving, booking_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_booking = $conn->prepare($insert_booking_query);
        $stmt_booking->bind_param("iissssss", $user_id, $packageID, $full_name, $location, $guests, $arrivals, $leaving, $bookingCode);

        if ($stmt_booking->execute()) {
            header("Location: thankyou.php?package_id=" . $packageID . "&package_title=" . $location . "&package_description=" . $guests);
        } else {
            echo "Error storing booking record: " . $stmt_booking->error;
        }
        $stmt_booking->close();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
