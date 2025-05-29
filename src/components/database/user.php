<?php include_once '../controller.php';?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnityGrid Dashboard</title>
       <link rel="stylesheet" href="../style/style.css">
       <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php
    $result = getAllUsers();

    foreach ($result as $user) {
        echo "ID: " . $user['id'] . "<br>";
        echo "Name: " . $user['name'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Phone: " . $user['phone'] . "<br>";
        echo "Password: " . $user['password'] . "<br>";
        echo "<hr>";
    }
    ?>
</body>
</html>