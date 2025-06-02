<?php
// signup_process.php - Handles user registration
// FIXED: Complete signup process with proper validation and database integration

include_once 'controller.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    
    // Server-side validation
    $errors = array();
    
    // Check required fields
    if (empty($name) || empty($email) || empty($phone) || empty($password)) {
        $errors[] = "All fields are required.";
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    
    // Check password length
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }
    
    // Check if passwords match
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }
    
    // Check if email already exists
    if (emailExists($email)) {
        $errors[] = "Email already exists. Please use a different email.";
    }
    
    // If no errors, proceed with registration
    if (empty($errors)) {
        // In production, you should hash the password
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $result = insertUser($name, $email, $phone, $password);
        
        if ($result === true) {
            // Success - redirect to login page with success message
            header("Location: sign_in.php?success=1");
            exit();
        } elseif ($result === "Email already exists") {
            // Email exists error
            header("Location: signup.php?error=email_exists");
            exit();
        } else {
            // General registration error
            header("Location: signup.php?error=registration_failed");
            exit();
        }
    } else {
        // Validation errors - redirect with first error
        $errorType = "validation_failed";
        if (in_array("Passwords do not match.", $errors)) {
            $errorType = "password_mismatch";
        } elseif (in_array("Email already exists. Please use a different email.", $errors)) {
            $errorType = "email_exists";
        }
        
        header("Location: signup.php?error=$errorType");
        exit();
    }
} else {
    // If not a POST request, redirect to signup page
    header("Location: signup.php");
    exit();
}
?>