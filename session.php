<?php
$session_timeout = 60; // 1 minute (you can adjust this value as needed)

// Start a session or resume the existing session
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Check if the session has expired
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
        // Session has expired, destroy it
        session_unset();
        session_destroy();

        // Set a cookie with an expiration time for the message
        $message = "Your session has expired. Please sign in again.";
        setcookie('session_message', $message, time() + 60, '/'); // Expires in 1 minute
        header('Location: login.html'); // Redirect to the login page
        exit; // Terminate script execution
    }

    // Update the last activity time
    $_SESSION['last_activity'] = time();
} else {
    // User is not logged in, redirect to the login page
    header('Location: login.php');
    exit; // Terminate script execution
}

?>
