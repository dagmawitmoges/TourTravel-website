<?php
session_start();

// Check if the user is logged in and is an admin
if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] === true) {
    // Display admin content here
    echo '<h1>Welcome Admin</h1>';
    echo '<p>This is the admin page where you can edit content.</p>';
} else {
    // Redirect unauthorized users to the login page or display an error message
    echo 'Unauthorized access.';
}
?>
