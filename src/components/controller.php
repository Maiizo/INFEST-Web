<?php
// ENHANCED CONTROLLER.PHP - Added session management and authentication functions
// Modified from original controller.php to include login/logout functionality

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function connectDB()
{
    $host = 'localhost';
    $user = "root";
    $password = "";
    $db = "UnityGrid_db";

    $conn = mysqli_connect($host, $user, $password, $db) or die("Error connecting to database");
    return $conn;
}

function closeDB($conn)
{
    mysqli_close($conn);
}

// NEW FUNCTION: User Authentication
function authenticateUser($email, $password)
{
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
            // Verify password (assuming plain text for now - in production use password_hash/password_verify)
            if ($password === $row["password"]) {
                $userData = array(
                    'id' => $row["user_id"],
                    'name' => $row["name"],
                    'email' => $row["email"],
                    'phone' => $row["phone"]
                );
                
                // Set session variables
                $_SESSION['user_id'] = $row["user_id"];
                $_SESSION['user_name'] = $row["name"];
                $_SESSION['user_email'] = $row["email"];
                $_SESSION['logged_in'] = true;
            }
        }
        
        mysqli_stmt_close($stmt);
        closeDB($conn);
    }
    return $userData;
}

// NEW FUNCTION: Check if user is logged in
function isLoggedIn()
{
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

// NEW FUNCTION: Get current user data
function getCurrentUser()
{
    if (isLoggedIn()) {
        return array(
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email']
        );
    }
    return null;
}

// NEW FUNCTION: Logout user
function logoutUser()
{
    session_unset();
    session_destroy();
}

// NEW FUNCTION: Check if email already exists
function emailExists($email)
{
    $conn = connectDB();
    $exists = false;

    if ($conn != NULL) {
        $sql_query = "SELECT COUNT(*) as count FROM `users` WHERE `email` = ?";
        $stmt = mysqli_prepare($conn, $sql_query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($result) {
            $row = $result->fetch_assoc();
            $exists = $row['count'] > 0;
        }
        
        mysqli_stmt_close($stmt);
        closeDB($conn);
    }
    return $exists;
}

// EXISTING FUNCTIONS (unchanged)
function getAllUsers()
{
    $allData = array();
    $conn = connectDB();

    if ($conn != NULL) {
        $sql_query = "SELECT * FROM `users`";
        $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data = array(); 
                $data['id'] = $row["user_id"];
                $data['name'] = $row["name"];
                $data['email'] = $row["email"];
                $data['phone'] = $row["phone"];
                $data['password'] = $row["password"];
                array_push($allData, $data);
            }
        }
        
        closeDB($conn);
    }
    return $allData;
}

function getAllCategories()
{
    $allData = array();
    $conn = connectDB();

    if ($conn != NULL) {
        $sql_query = "SELECT * FROM `categories`";
        $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data = array();
                $data['id'] = $row["category_id"];
                $data['name'] = $row["categories_name"];
                array_push($allData, $data);
            }
        }
        
        closeDB($conn);
    }
    return $allData;
}

function getAllStatus()
{
    $allData = array();
    $conn = connectDB();

    if ($conn != NULL) {
        $sql_query = "SELECT * FROM `status`";
        $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data = array();
                $data['id'] = $row["status_id"];
                $data['name'] = $row["status_name"];
                array_push($allData, $data);
            }
        }
        
        closeDB($conn);
    }
    return $allData;
}

function getAllHelpRequests()
{
    $allData = array();
    $conn = connectDB();

    if ($conn != NULL) {
        $sql_query = "SELECT * FROM `help_requests`";
        $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data = array();
                $data['id'] = $row["help_request_id"];
                $data['name_of_product'] = $row["name_of_product"];
                $data['product_description'] = $row["product_description"];
                $data['help_request_phone'] = $row["help_request_phone"];
                $data['help_request_email'] = $row["help_request_email"];
                $data['exchange_product_name'] = $row["exchange_product_name"];
                $data['exchange_product_description'] = $row["exchange_product_description"];
                $data['help_request_location'] = $row["help_request_location"];
                $data['users_id'] = $row["users_id"];
                $data['categories_id'] = $row["categories_id"];
                $data['status_id'] = $row["status_id"];
                $data['help_request_image_url'] = $row["help_request_image_url"];
                array_push($allData, $data);
            }
        }
        
        closeDB($conn);
    }
    return $allData;
}

// NEW FUNCTION: Get help requests for browse offers with user details
function getHelpRequestsForBrowse($filter = 'all', $category = '', $location = '')
{
    $allData = array();
    $conn = connectDB();

    if ($conn != NULL) {
        $sql_query = "SELECT hr.*, u.name as user_name, c.categories_name, s.status_name 
                      FROM help_requests hr 
                      LEFT JOIN users u ON hr.users_id = u.user_id 
                      LEFT JOIN categories c ON hr.categories_id = c.category_id 
                      LEFT JOIN status s ON hr.status_id = s.status_id 
                      WHERE 1=1";
        
        $params = array();
        $types = "";
        
        // Apply filters
        if ($filter !== 'all') {
            $sql_query .= " AND c.categories_name = ?";
            $params[] = $filter;
            $types .= "s";
        }
        
        if (!empty($category)) {
            $sql_query .= " AND c.categories_name = ?";
            $params[] = $category;
            $types .= "s";
        }
        
        if (!empty($location)) {
            $sql_query .= " AND hr.help_request_location LIKE ?";
            $params[] = "%" . $location . "%";
            $types .= "s";
        }
        
        $sql_query .= " ORDER BY hr.help_request_id DESC";
        
        if (!empty($params)) {
            $stmt = mysqli_prepare($conn, $sql_query);
            mysqli_stmt_bind_param($stmt, $types, ...$params);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } else {
            $result = mysqli_query($conn, $sql_query);
        }

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data = array();
                $data['id'] = $row["help_request_id"];
                $data['name_of_product'] = $row["name_of_product"];
                $data['product_description'] = $row["product_description"];
                $data['help_request_phone'] = $row["help_request_phone"];
                $data['help_request_email'] = $row["help_request_email"];
                $data['exchange_product_name'] = $row["exchange_product_name"];
                $data['exchange_product_description'] = $row["exchange_product_description"];
                $data['help_request_location'] = $row["help_request_location"];
                $data['users_id'] = $row["users_id"];
                $data['user_name'] = $row["user_name"];
                $data['categories_id'] = $row["categories_id"];
                $data['category_name'] = $row["categories_name"];
                $data['status_id'] = $row["status_id"];
                $data['status_name'] = $row["status_name"];
                $data['help_request_image_url'] = $row["help_request_image_url"];
                array_push($allData, $data);
            }
        }
        
        if (isset($stmt)) {
            mysqli_stmt_close($stmt);
        }
        closeDB($conn);
    }
    return $allData;
}

function getAllExchangeInformations()
{
    $allData = array();
    $conn = connectDB();

    if ($conn != NULL) {
        $sql_query = "SELECT * FROM `exchange_informations`";
        $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data = array();
                $data['id'] = $row["exchange_information_id"];
                $data['name'] = $row["exchange_information_name"];
                $data['phone'] = $row["exchange_information_phone"];
                $data['email'] = $row["exchange_information_email"];
                $data['description'] = $row["exchange_information_description"];
                $data['help_requests_id'] = $row["help_requests_id"];
                array_push($allData, $data);
            }
        }
        
        closeDB($conn);
    }
    return $allData;
}

function getAllResponses()
{
    $allData = array();
    $conn = connectDB();

    if ($conn != NULL) {
        $sql_query = "SELECT * FROM `responses`";
        $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data = array();
                $data['id'] = $row["response_id"];
                $data['users_id'] = $row["users_id"];
                $data['help_requests_id'] = $row["help_requests_id"];
                $data['exchange_informations_id'] = $row["exchange_informations_id"];
                array_push($allData, $data);
            }
        }
        
        closeDB($conn);
    }
    return $allData;
}

// Helper functions (unchanged)
function getUserById($userId)
{
    $conn = connectDB();
    $userData = null;

    if ($conn != NULL) {
        $sql_query = "SELECT * FROM `users` WHERE `user_id` = ?";
        $stmt = mysqli_prepare($conn, $sql_query);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userData = array(
                'id' => $row["user_id"],
                'name' => $row["name"],
                'email' => $row["email"],
                'phone' => $row["phone"],
                'password' => $row["password"]
            );
        }
        
        mysqli_stmt_close($stmt);
        closeDB($conn);
    }
    return $userData;
}

function getHelpRequestById($helpRequestId)
{
    $conn = connectDB();
    $requestData = null;

    if ($conn != NULL) {
        $sql_query = "SELECT * FROM `help_requests` WHERE `help_request_id` = ?";
        $stmt = mysqli_prepare($conn, $sql_query);
        mysqli_stmt_bind_param($stmt, "i", $helpRequestId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $requestData = array(
                'id' => $row["help_request_id"],
                'name_of_product' => $row["name_of_product"],
                'product_description' => $row["product_description"],
                'help_request_phone' => $row["help_request_phone"],
                'help_request_email' => $row["help_request_email"],
                'exchange_product_name' => $row["exchange_product_name"],
                'exchange_product_description' => $row["exchange_product_description"],
                'help_request_location' => $row["help_request_location"],
                'users_id' => $row["users_id"],
                'categories_id' => $row["categories_id"],
                'status_id' => $row["status_id"],
                'help_request_image_url' => $row["help_request_image_url"]
            );
        }
        
        mysqli_stmt_close($stmt);
        closeDB($conn);
    }
    return $requestData;
}

// Insert functions (unchanged but with enhanced error handling)
function insertUser($name, $email, $phone, $password)
{
    $conn = connectDB();
    $success = false;

    if ($conn != NULL) {
        // Check if email already exists
        if (emailExists($email)) {
            return "Email already exists";
        }
        
        $sql_query = "INSERT INTO `users` (`name`, `email`, `phone`, `password`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql_query);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $password);
        
        if (mysqli_stmt_execute($stmt)) {
            $success = true;
        }
        
        mysqli_stmt_close($stmt);
        closeDB($conn);
    }
    return $success;
}

function insertHelpRequest($nameOfProduct, $productDescription, $phone, $email, $exchangeProductName, $exchangeProductDescription, $location, $usersId, $categoriesId, $statusId, $imageUrl = null)
{
    $conn = connectDB();
    $success = false;

    if ($conn != NULL) {
        $sql_query = "INSERT INTO `help_requests` (`name_of_product`, `product_description`, `help_request_phone`, `help_request_email`, `exchange_product_name`, `exchange_product_description`, `help_request_location`, `users_id`, `categories_id`, `status_id`, `help_request_image_url`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql_query);
        mysqli_stmt_bind_param($stmt, "sssssssiiis", $nameOfProduct, $productDescription, $phone, $email, $exchangeProductName, $exchangeProductDescription, $location, $usersId, $categoriesId, $statusId, $imageUrl);
        
        if (mysqli_stmt_execute($stmt)) {
            $success = mysqli_insert_id($conn); // Return the inserted ID
        }
        
        mysqli_stmt_close($stmt);
        closeDB($conn);
    }
    return $success;
}

function insertExchangeInformation($name, $phone, $email, $description, $helpRequestsId)
{
    $conn = connectDB();
    $success = false;

    if ($conn != NULL) {
        $sql_query = "INSERT INTO `exchange_informations` (`exchange_information_name`, `exchange_information_phone`, `exchange_information_email`, `exchange_information_description`, `help_requests_id`) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql_query);
        mysqli_stmt_bind_param($stmt, "ssssi", $name, $phone, $email, $description, $helpRequestsId);
        
        if (mysqli_stmt_execute($stmt)) {
            $success = true;
        }
        
        mysqli_stmt_close($stmt);
        closeDB($conn);
    }
    return $success;
}

function insertResponse($usersId, $helpRequestsId, $exchangeInformationsId)
{
    $conn = connectDB();
    $success = false;

    if ($conn != NULL) {
        $sql_query = "INSERT INTO `responses` (`users_id`, `help_requests_id`, `exchange_informations_id`) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql_query);
        mysqli_stmt_bind_param($stmt, "iii", $usersId, $helpRequestsId, $exchangeInformationsId);
        
        if (mysqli_stmt_execute($stmt)) {
            $success = true;
        }
        
        mysqli_stmt_close($stmt);
        closeDB($conn);
    }
    return $success;
}

?>