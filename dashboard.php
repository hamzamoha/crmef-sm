<?php
require_once(__DIR__ . '/Includes/Models/Students.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/CSS/fonts.css">
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="/FontAwesome6/css/all.min.css">
    <script src="/JS/jquery.min.js"></script>
    <script src="/JS/script.js"></script>
</head>

<body>
    <header class="header">
        <?php include('navbar.php'); ?>
    </header>

    <?php
    var_dump(Students::get(1));
    ?>
</body>

</html>