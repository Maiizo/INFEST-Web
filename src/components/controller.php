<?php

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
        
        closeDB($conn); // Close the database connection
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

// Helper functions to get specific records by ID
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

// Insert functions
function insertUser($name, $email, $phone, $password)
{
    $conn = connectDB();
    $success = false;

    if ($conn != NULL) {
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
            $success = true;
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

