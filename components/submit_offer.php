<?php
// SUBMIT_OFFER.PHP - Handles offer submission
// NEW FILE: Processes offer form data and saves to database

include_once 'controller.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header("Location: ./PostOffers.html?error=login_required");
    exit();
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentUser = getCurrentUser();
    
    // Sanitize and validate input data
    $productName = trim($_POST['product_name']);
    $categoryId = (int)$_POST['category'];
    $city = trim($_POST['city']);
    $description = trim($_POST['description']);
    $exchangeProduct = trim($_POST['exchange_product']);
    $exchangeDescription = trim($_POST['exchange_description']);
    $contactEmail = trim($_POST['contact_email']);
    $contactNumber = trim($_POST['contact_number']);
    
    // Server-side validation
    $errors = array();
    
    // Check required fields
    if (empty($productName) || empty($categoryId) || empty($city) || empty($description) || 
        empty($exchangeProduct) || empty($exchangeDescription) || empty($contactEmail)) {
        $errors[] = "All required fields must be filled.";
    }
    
    // Validate email format
    if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    
    // Handle image upload
    $imageUrl = null;
    if (isset($_FILES['offer_image']) && $_FILES['offer_image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '/www/html/uploads/'; // Use absolute path for Docker volume
        
        // Create uploads directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
            // Ensure proper ownership for unit user
            chown($uploadDir, 'unit');
            chgrp($uploadDir, 'unit');
        }
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $_FILES['offer_image']['type'];
        
        if (in_array($fileType, $allowedTypes)) {
            $fileName = uniqid() . '_' . basename($_FILES['offer_image']['name']);
            $targetPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['offer_image']['tmp_name'], $targetPath)) {
                $imageUrl = 'uploads/' . $fileName; // This assumes your web server serves /www/html as document root
            } else {
                $errors[] = "Failed to upload image.";
            }
        } else {
            $errors[] = "Invalid image format. Only JPEG, PNG, and GIF are allowed.";
        }
    }
    
    // If no errors, proceed with insertion
    if (empty($errors)) {
        // Insert help request into database
        $result = insertHelpRequest(
            $productName,
            $description,
            $contactNumber,
            $contactEmail,
            $exchangeProduct,
            $exchangeDescription,
            $city,
            $currentUser['id'],
            $categoryId,
            1, // Default status ID (assuming 1 = active)
            $imageUrl
        );
        
        if ($result) {
            // Success - redirect with success message
            header("Location: /src/components/PostOffers.html?success=1");
            exit();
        } else {
            // Database insertion failed
            header("Location: /src/components/PostOffers.html?error=database_error");
            exit();
        }
    } else {
        // Validation errors
        header("Location: /src/components/PostOffers.html?error=validation_failed");
        exit();
    }
} else {
    // If not a POST request, redirect to post offers page
    header("Location: /src/components/PostOffers.html");
    exit();
}
?>