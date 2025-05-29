<?php include_once '../controller.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status - UnityGrid Dashboard</title>
       <link rel="stylesheet" href="../style/style.css">
       <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1 class="text-2xl font-bold mb-4">Status Database</h1>
    <?php
    $result = getAllStatus();

    foreach ($result as $status) {
        echo "ID: " . $status['id'] . "<br>";
        echo "Status Name: " . $status['name'] . "<br>";
        echo "<hr>";
    }
    ?>
</body>
</html>