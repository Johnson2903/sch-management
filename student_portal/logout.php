<?php
// Start the session
session_start();

// Clear session data
session_unset();

// Destroy the session
session_destroy();

// Clear session-related cookies
// setcookie("cookie_name", "", time() - 3600, "/");

// Redirect to the login page
header("Location: index.php");
exit();
?>
