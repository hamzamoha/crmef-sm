<?php
require_once(__DIR__ . "/../Includes/Functions.php");
require_once(__DIR__ . '/../Includes/Models/Students.php');
require_once(__DIR__ . '/../Includes/Models/Courses.php');
require_once(__DIR__ . '/../Includes/Models/Tests.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Space</title>
    <link rel="stylesheet" href="/CSS/fonts.css">
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="/FontAwesome6/css/all.min.css">
    <script src="/JS/jquery.min.js"></script>
    <script src="/JS/script.js"></script>
    <style>
        body {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <header class="header">
        <?php include(__DIR__ . '/../navbar.php'); ?>
    </header>
    <main>
        <div class="dashboard">
            <div class="dashboard-sidebar">
                <?php include(__DIR__ . "/dashboard-sidebar-menu.php"); ?>
            </div>
            <div class="dashboard-content">
                <div class="dashboard-boxes">
                    <a href="courses.php" class="box" style="width:40%;">
                        <div class="box-body">
                            <div class="box-icon"><i class="fa-solid fa-book"></i></div>
                            <div class="box-title">Courses</div>
                            <div class="box-description"><?= Courses::count(); ?></div>
                        </div>
                    </a>
                    <a href="tests.php" class="box" style="width:26%;">
                        <div class="box-body">
                            <div class="box-icon"><i class="fa-solid fa-file-lines"></i></div>
                            <div class="box-title">Tests</div>
                            <div class="box-description"><?= Tests::count(); ?></div>
                        </div>
                    </a>
                    <a href="#" class="box" style="width:34%;">
                        <div class="box-body">
                            <div class="box-icon"><i class="fa-solid fa-file-lines"></i></div>
                            <div class="box-title">Assignments</div>
                            <div class="box-description">3</div>
                        </div>
                    </a>
                    <a href="#" class="box" style="width:35%;">
                        <div class="box-body">
                            <div class="box-icon"><i class="fa-solid fa-file-lines"></i></div>
                            <div class="box-title">BOX</div>
                            <div class="box-description">description</div>
                        </div>
                    </a>
                    <a href="#" class="box" style="width:30%;">
                        <div class="box-body">
                            <div class="box-icon"><i class="fa-solid fa-file-lines"></i></div>
                            <div class="box-title">Another</div>
                            <div class="box-description">300</div>
                        </div>
                    </a>
                    <a href="#" class="box" style="width:35%;">
                        <div class="box-body">
                            <div class="box-icon"><i class="fa-solid fa-file-lines"></i></div>
                            <div class="box-title">Fill in</div>
                            <div class="box-description">WITH in</div>
                        </div>
                    </a>
                    <a href="#" class="box" style="width:30%;">
                        <div class="box-body">
                            <div class="box-icon"><i class="fa-solid fa-file-lines"></i></div>
                            <div class="box-title">Cool IT DOWN</div>
                            <div class="box-description">So coooold</div>
                        </div>
                    </a>
                    <a href="#" class="box" style="width:45%;">
                        <div class="box-body">
                            <div class="box-icon"><i class="fa-solid fa-file-lines"></i></div>
                            <div class="box-title">How ?</div>
                            <div class="box-description">When and Why ?</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>