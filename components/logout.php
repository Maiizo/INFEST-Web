<?php
// LOGOUT.PHP - Simple session destruction like PDF approach
session_start();

// Clear all session variables
session_unset();

// Destroy the session completely
session_destroy();

// Redirect to home page
header("Location: /views/home.php?logout=success");
exit();
?>