<?php
// Start a session (if not already started)
session_start();

// Destroy the session
session_destroy();

// Redirect to the login page after logging out
header("Location: login.php");
exit();
?>
