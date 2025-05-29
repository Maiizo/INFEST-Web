<?php include_once '../controller.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange Informations - UnityGrid Dashboard</title>
       <link rel="stylesheet" href="../style/style.css">
       <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1 class="text-2xl font-bold mb-4">Exchange Informations Database</h1>
    <?php
    $result = getAllExchangeInformations();

    foreach ($result as $exchange) {
        echo "ID: " . $exchange['id'] . "<br>";
        echo "Name: " . $exchange['name'] . "<br>";
        echo "Phone: " . $exchange['phone'] . "<br>";
        echo "Email: " . $exchange['email'] . "<br>";
        echo "Description: " . $exchange['description'] . "<br>";
        echo "Help Request ID: " . $exchange['help_requests_id'] . "<br>";
        echo "<hr>";
    }
    ?>
</body>
</html>