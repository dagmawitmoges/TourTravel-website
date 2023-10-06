<?php
$session_timeout = 60; 

session_start();

if (isset($_SESSION['username'])) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
        session_unset();
        session_destroy();

        $message = "Your session has expired. Please sign in again.";
        setcookie('session_message', $message, time() + 540, '/'); 

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit; 
    }


    $_SESSION['last_activity'] = time();
} else {
    header('Location: login.html');
    exit; 
}

?>
