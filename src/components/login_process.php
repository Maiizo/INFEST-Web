<?php
// LOGIN_PROCESS.PHP - Handles user login authentication
// NEW FILE: Processes login form data and manages sessions

include_once '../components/controller.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input data
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Validate input
    if (empty($email) || empty($password)) {
        header("Location: ../components/SignIn.html?error=empty_fields");
        exit();
    }
    
    // Attempt to authenticate user
    $userData = authenticateUser($email, $password);
    
    if ($userData) {
        // Login successful - redirect to home page
        header("Location: ../views/home.php?login=success");
        exit();
    } else {
        // Login failed - redirect back with error
        header("Location: ../components/SignIn.html?error=invalid_credentials");
        exit();
    }
} else {
    // If not a POST request, redirect to login page
    header("Location: ../components/SignIn.html");
    exit();
}
?>