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
                $data = array(); // Initialize array for each row
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>
    <?php
    $users = getAllUsers(); // Get array of user data
    
    if (!empty($users)) {
        foreach($users as $user) {
            echo "<h1>" . htmlspecialchars($user['name']) . "</h1>";
            echo "<p>Email: " . htmlspecialchars($user['email']) . "</p>";
            echo "<p>Phone: " . htmlspecialchars($user['phone']) . "</p>";
            echo "<hr>";
        }
    } else {
        echo "<p>No users found.</p>";
    }
    ?>
</body>
</html>