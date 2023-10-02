<?php
$session_timeout = 60; 

session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
        session_unset();
        session_destroy();

        $message = "Your session has expired. Please sign in again.";
        setcookie('session_message', $message, time() + 60, '/'); 

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit; 
    }

    // Update the last activity time
    $_SESSION['last_activity'] = time();
} else {
    header('Location: login.html');
    exit; 
}

?>
