<?php include_once '../controller.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responses - UnityGrid Dashboard</title>
       <link rel="stylesheet" href="../style/style.css">
       <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1 class="text-2xl font-bold mb-4">Responses Database</h1>
    <?php
    $result = getAllResponses();

    foreach ($result as $response) {
        echo "Response ID: " . $response['id'] . "<br>";
        echo "User ID: " . $response['users_id'] . "<br>";
        echo "Help Request ID: " . $response['help_requests_id'] . "<br>";
        echo "Exchange Information ID: " . $response['exchange_informations_id'] . "<br>";
        echo "<hr>";
    }
    ?>
</body>
</html>