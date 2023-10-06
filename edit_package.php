<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "register";


$conn = new mysqli($hostname, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["package_id"])) {
    $package_id = $_GET["package_id"];

    
    $sql = "SELECT * FROM Packages WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = $row["Title"];
        $description = $row["Description"];
        $imagePath = $row["Image_path"];
    } else {
        echo "Package not found.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["newTitle"]) && isset($_POST["newDescription"])) {
    $newTitle = $_POST["newTitle"];
    $newDescription = $_POST["newDescription"];

   
    $updateSql = "UPDATE Packages SET Title = ?, Description = ? WHERE ID = ?";
    $stmt = $conn->prepare($updateSql);
    
    if ($stmt) {
        $stmt->bind_param("ssi", $newTitle, $newDescription, $package_id);
        
        if ($stmt->execute()) {
            echo "Package information updated successfully.";
           
            $title = $newTitle;
            $description = $newDescription;
        } else {
            echo "Error updating package information: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Error preparing the update statement: " . $conn->error;
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Package</title>
</head>
<body>
    <h1>Edit Package</h1>
    <form method="post">
        <label for="newTitle">Title:</label>
        <input type="text" id="newTitle" name="newTitle" value="<?php echo $title; ?>"><br>

        <label for="newDescription">Description:</label>
        <textarea id="newDescription" name="newDescription"><?php echo $description; ?></textarea><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
