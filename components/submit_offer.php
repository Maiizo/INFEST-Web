<?php
// SUBMIT_OFFER.PHP - Handles offer submission
// NEW FILE: Processes offer form data and saves to database

include_once __DIR__ . '/config.php';
include_once __DIR__ . '/controller.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header("Location: /views/post_offers.php?error=login_required");
    exit();
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentUser = getCurrentUser();
    
    // Sanitize and validate input data
    $productName = trim($_POST['product_name']);
    $categoryId = (int)$_POST['category'];
    $location = trim($_POST['location']);
    $customCity = trim($_POST['custom_city']);
    $description = trim($_POST['description']);
    $exchangeProduct = trim($_POST['exchange_product']);
    $exchangeDescription = trim($_POST['exchange_description']);
    $contactEmail = trim($_POST['contact_email']);
    $contactNumber = trim($_POST['contact_number']);
    
    // Determine final location value
    $finalLocation = '';
    if ($location === 'Other') {
        $finalLocation = $customCity;
    } else {
        $finalLocation = $location;
    }
    
    // Server-side validation
    $errors = array();
    
    // Check required fields (including location validation)
    if (empty($productName) || empty($categoryId) || empty($finalLocation) || empty($description) || 
        empty($exchangeProduct) || empty($exchangeDescription) || empty($contactEmail)) {
        $errors[] = "All required fields must be filled.";
    }
    
    // Additional validation for custom location
    if ($location === 'Other' && empty($customCity)) {
        $errors[] = "Please enter your custom location.";
    }
    
    // Validate email format
    if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    
    // Handle image upload
    $imageUrl = null;
    if (isset($_FILES['offer_image']) && $_FILES['offer_image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = getUploadDirectory();
        $fileType = $_FILES['offer_image']['type'];
        
        if (in_array($fileType, ALLOWED_IMAGE_TYPES)) {
            $fileName = createSafeFilename($_FILES['offer_image']['name']);
            $targetPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['offer_image']['tmp_name'], $targetPath)) {
                $imageUrl = UPLOADS_URL . $fileName; // Use defined constant for URL
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
            $finalLocation, // Use final processed location
            $currentUser['id'],
            $categoryId,
            1, // Default status ID (assuming 1 = active)
            $imageUrl
        );
        
        if ($result) {
            // Success - redirect with success message
            header("Location: /views/post_offers.php?success=1");
            exit();
        } else {
            // Database insertion failed
            header("Location: /views/post_offers.php?error=database_error");
            exit();
        }
    } else {
        // Validation errors
        header("Location: /views/post_offers.php?error=validation_failed");
        exit();
    }
} else {
    // If not a POST request, redirect to post offers page
    header("Location: /views/post_offers.php");
    exit();
}
?>