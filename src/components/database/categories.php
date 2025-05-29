<?php include_once '../controller.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - UnityGrid Dashboard</title>
       <link rel="stylesheet" href="../style/style.css">
       <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1 class="text-2xl font-bold mb-4">Categories Database</h1>
    <?php
    $result = getAllCategories();

    foreach ($result as $category) {
        echo "ID: " . $category['id'] . "<br>";
        echo "Category Name: " . $category['name'] . "<br>";
        echo "<hr>";
    }
    ?>
</body>
</html>