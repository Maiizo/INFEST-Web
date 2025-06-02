<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnityGrid - Community Exchange Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body class="is-home">
    <!-- <h1>halo ini home bro</h1> -->
    <?php include '../components/navbar.php' ?>
    <?php include '../components/home/hero.php' ?>
    <?php include '../components/home/section2.php' ?>
    <?php include '../components/home/section3.php' ?>
    <?php include '../components/home/review.php' ?>
    <?php include '../components/footer.php' ?>
    <?php include '../components/shopping_cart.php' ?>
</body>

</html>