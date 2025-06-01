<?php
// LOGOUT.PHP - Handles user logout
// NEW FILE: Destroys session and redirects to home page

include_once '../components/controller.php';

// Logout the user
logoutUser();

// Redirect to home page with logout message
header("Location: ../views/home.php?logout=success");
exit();
?>