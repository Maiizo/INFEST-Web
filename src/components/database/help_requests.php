<?php include_once '../controller.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Requests - UnityGrid Dashboard</title>
       <link rel="stylesheet" href="../style/style.css">
       <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1 class="text-2xl font-bold mb-4">Help Requests Database</h1>
    <?php
    $result = getAllHelpRequests();

    foreach ($result as $request) {
        echo "ID: " . $request['id'] . "<br>";
        echo "Product Name: " . $request['name_of_product'] . "<br>";
        echo "Product Description: " . $request['product_description'] . "<br>";
        echo "Phone: " . $request['help_request_phone'] . "<br>";
        echo "Email: " . $request['help_request_email'] . "<br>";
        echo "Exchange Product Name: " . $request['exchange_product_name'] . "<br>";
        echo "Exchange Product Description: " . $request['exchange_product_description'] . "<br>";
        echo "Location: " . $request['help_request_location'] . "<br>";
        echo "User ID: " . $request['users_id'] . "<br>";
        echo "Category ID: " . $request['categories_id'] . "<br>";
        echo "Status ID: " . $request['status_id'] . "<br>";
        echo "Image URL: " . ($request['help_request_image_url'] ?? 'No image') . "<br>";
        echo "<hr>";
    }
    ?>
</body>
</html>