<?php
// AUTH_CHECK.PHP - Simple authentication check like PDF approach
// Start session
session_start();

// Simple function to require login for protected pages
function requireLogin($redirectTo = '/components/sign_in.php') {
    // Check if essential session variables exist
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['name'])) {
        header("Location: $redirectTo?error=login_required");
        exit();
    }
}

// Simple function to redirect logged-in users away from auth pages
function redirectIfLoggedIn($redirectTo = '/views/home.php') {
    // Check if user is already logged in
    if (isset($_SESSION['user_id']) && isset($_SESSION['name'])) {
        header("Location: $redirectTo");
        exit();
    }
}

// Simple function to check if user owns a specific resource
function requireOwnership($userId, $redirectTo = '/views/home.php') {
    // Check if user is logged in first
    if (!isset($_SESSION['user_id'])) {
        header("Location: /components/sign_in.php?error=login_required");
        exit();
    }
    
    // Check if user owns the resource
    if ($_SESSION['user_id'] != $userId) {
        header("Location: $redirectTo?error=access_denied");
        exit();
    }
}
?>