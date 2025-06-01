<?php
// SEED_DATABASE.PHP - Database seeder for initial data
// NEW FILE: Populates database with initial categories and status data

include_once '../components/controller.php';

// Function to seed categories
function seedCategories() {
    $conn = connectDB();
    
    // Check if categories already exist
    $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM categories");
    $row = mysqli_fetch_assoc($result);
    
    if ($row['count'] == 0) {
        // Insert default categories
        $categories = [
            ['id' => 1, 'name' => 'Goods'],
            ['id' => 2, 'name' => 'Services']
        ];
        
        foreach ($categories as $category) {
            $stmt = mysqli_prepare($conn, "INSERT INTO categories (category_id, categories_name) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "is", $category['id'], $category['name']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        
        echo "Categories seeded successfully.\n";
    } else {
        echo "Categories already exist.\n";
    }
    
    closeDB($conn);
}

// Function to seed status
function seedStatus() {
    $conn = connectDB();
    
    // Check if status already exist
    $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM status");
    $row = mysqli_fetch_assoc($result);
    
    if ($row['count'] == 0) {
        // Insert default status
        $statuses = [
            ['id' => 1, 'name' => 'Active'],
            ['id' => 2, 'name' => 'Pending'],
            ['id' => 3, 'name' => 'Completed'],
            ['id' => 4, 'name' => 'Cancelled']
        ];
        
        foreach ($statuses as $status) {
            $stmt = mysqli_prepare($conn, "INSERT INTO status (status_id, status_name) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "is", $status['id'], $status['name']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        
        echo "Status seeded successfully.\n";
    } else {
        echo "Status already exist.\n";
    }
    
    closeDB($conn);
}

// Function to create uploads directory
function createUploadsDirectory() {
    $uploadDir = '../uploads/';
    
    if (!file_exists($uploadDir)) {
        if (mkdir($uploadDir, 0777, true)) {
            echo "Uploads directory created successfully.\n";
        } else {
            echo "Failed to create uploads directory.\n";
        }
    } else {
        echo "Uploads directory already exists.\n";
    }
}

// Run the seeder
echo "Starting database seeding...\n";
seedCategories();
seedStatus();
createUploadsDirectory();
echo "Database seeding completed!\n";
?>

<!-- HTML interface for running seeder -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Seeder - UnityGrid</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">Database Seeder</h1>
        <p class="text-gray-600 mb-6 text-center">Initialize your database with default categories and status values.</p>
        
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <h3 class="font-semibold text-green-800 mb-2">Seeding Complete!</h3>
            <p class="text-green-700 text-sm">Your database has been initialized with default data.</p>
        </div>
        
        <div class="space-y-4">
            <a href="../views/home.php" 
               class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg text-center block transition-colors duration-200">
                Go to Home Page
            </a>
            
            <a href="../components/Database.html" 
               class="w-full bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg text-center block transition-colors duration-200">
                View Database
            </a>
        </div>
    </div>
</body>
</html>