<?php
// LOGIN_PROCESS.PHP - Simple session approach similar to PDF example
// Modified to use basic session handling like the PDF document

// Start session at the beginning
session_start();

include_once '../components/controller.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get input data
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Basic validation
    if (empty($email) || empty($password)) {
        header("Location: ../components/SignIn.html?error=empty_fields");
        exit();
    }
    
    // Connect to database and check credentials
    $conn = connectDB();
    $userData = null;

    if ($conn != NULL) {
        $sql_query = "SELECT * FROM `users` WHERE `email` = ?";
        $stmt = mysqli_prepare($conn, $sql_query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Check password (plain text comparison like PDF approach)
            if ($password === $row["password"]) {
                // Login successful - Set simple session variables like PDF
                $_SESSION['user_id'] = $row["user_id"];
                $_SESSION['name'] = $row["name"];
                $_SESSION['email'] = $row["email"];
                $_SESSION['phone'] = $row["phone"];
                
                // Redirect to home page
                mysqli_stmt_close($stmt);
                closeDB($conn);
                header("Location: ../views/home.php");
                exit();
            }
        }
        
        mysqli_stmt_close($stmt);
        closeDB($conn);
    }
    
    // If we reach here, login failed
    header("Location: ../components/SignIn.html?error=invalid_credentials");
    exit();
    
} else {
    // If not a POST request, redirect to login page
    header("Location: ../components/SignIn.html");
    exit();
}
?>