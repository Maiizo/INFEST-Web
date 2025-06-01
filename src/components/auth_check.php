<?php
// AUTH_CHECK.PHP - Authentication middleware
// NEW FILE: Protects pages that require user login

include_once __DIR__ . '/controller.php';

// Function to require login for protected pages
function requireLogin($redirectTo = '../components/SignIn.html') {
    if (!isLoggedIn()) {
        header("Location: $redirectTo?error=login_required");
        exit();
    }
}

// Function to redirect logged-in users away from auth pages
function redirectIfLoggedIn($redirectTo = '../views/home.php') {
    if (isLoggedIn()) {
        header("Location: $redirectTo");
        exit();
    }
}

// Function to check if user owns a specific resource
function requireOwnership($userId, $redirectTo = '../views/home.php') {
    $currentUser = getCurrentUser();
    if (!$currentUser || $currentUser['id'] != $userId) {
        header("Location: $redirectTo?error=access_denied");
        exit();
    }
}
?>