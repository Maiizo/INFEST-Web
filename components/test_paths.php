<?php
// TEST_PATHS.PHP - Test script to verify path configurations
// This file can be used to debug and verify path settings

include_once 'config.php';

echo "<h2>Path Configuration Test</h2>\n";
echo "<p><strong>Environment Information:</strong></p>\n";
echo "<ul>\n";
echo "<li>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</li>\n";
echo "<li>Current Script: " . __FILE__ . "</li>\n";
echo "<li>App Root: " . APP_ROOT . "</li>\n";
echo "<li>Uploads Directory: " . UPLOADS_DIR . "</li>\n";
echo "<li>Uploads URL: " . UPLOADS_URL . "</li>\n";
echo "</ul>\n";

echo "<p><strong>Database Configuration:</strong></p>\n";
echo "<ul>\n";
echo "<li>DB Host: " . DB_HOST . "</li>\n";
echo "<li>DB User: " . DB_USER . "</li>\n";
echo "<li>DB Name: " . DB_NAME . "</li>\n";
echo "</ul>\n";

echo "<p><strong>Directory Status:</strong></p>\n";
echo "<ul>\n";

$uploadDir = getUploadDirectory();
if (file_exists($uploadDir)) {
    echo "<li>✅ Upload directory exists: " . $uploadDir . "</li>\n";
    echo "<li>Directory permissions: " . substr(sprintf('%o', fileperms($uploadDir)), -4) . "</li>\n";
    echo "<li>Directory is writable: " . (is_writable($uploadDir) ? "Yes" : "No") . "</li>\n";
} else {
    echo "<li>❌ Upload directory does not exist: " . $uploadDir . "</li>\n";
}

echo "</ul>\n";

// Test file creation
$testFile = $uploadDir . 'test_' . time() . '.txt';
if (file_put_contents($testFile, 'test content')) {
    echo "<p>✅ Test file creation successful: " . basename($testFile) . "</p>\n";
    unlink($testFile); // Clean up
} else {
    echo "<p>❌ Test file creation failed</p>\n";
}

echo "<p><em>Note: Remove this file in production environments.</em></p>\n";
?> 