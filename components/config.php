<?php
// CONFIG.PHP - Application configuration
// This file contains environment-agnostic configuration settings

// Define application paths
define('APP_ROOT', dirname(__DIR__)); // Project root directory
define('UPLOADS_DIR', $_SERVER['DOCUMENT_ROOT'] . '/uploads/'); // Dynamic upload directory
define('UPLOADS_URL', '/uploads/'); // URL path for uploaded files

// Database configuration (with fallbacks for different environments)
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1'); // $DB_HOST = getenv('DB_HOST') ? getenv('DB_HOST') : '127.0.0.1';
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'UnityGrid_db');

// File upload settings
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif']);

// Application settings
define('APP_NAME', 'UnityGrid');
define('APP_VERSION', '1.0.0');

// Helper function to get upload directory
function getUploadDirectory() {
    $uploadDir = UPLOADS_DIR;
    
    // Create directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
        
        // Set proper permissions for web server
        if (function_exists('posix_getpwnam')) {
            // Try common web server users
            $webUsers = ['www-data', 'apache', 'nginx', 'unit'];
            foreach ($webUsers as $user) {
                if (posix_getpwnam($user)) {
                    chown($uploadDir, $user);
                    chgrp($uploadDir, $user);
                    break;
                }
            }
        }
    }
    
    return $uploadDir;
}

// Helper function to create a safe filename
function createSafeFilename($originalName) {
    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
    return uniqid() . '_' . time() . '.' . $extension;
}