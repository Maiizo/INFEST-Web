<?php

function connectDB()
{
    $host = 'localhost';
    $user = "root";
    $password = "";
    $db = "UnityGrid_db";

    $conn = mysqli_connect($host, $user, $password, $db) or die("Error");

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
        $sql_query = "SELECT * FROM  `users`";
        $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data['id'] =  $row["user_id"];
                $data['name'] =  $row["name"];
                $data['email'] =  $row["email"];
                $data['phone'] =  $row["phone"];
                $data['password']   =  $row["password"];
                array_push($allData, $data);
            }
        }
    }
    return $allData;
}
