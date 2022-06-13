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
                <div class="courses">
                    <h1 class="content-title">Courses</h1>
                    <div class="courses-cards">
                        <div class="course-card">
                            <div class="course-card-thumbnail">
                                <img src="/Images/course-1.jpg" alt="Course 1" title="Course 1">
                            </div>
                            <a href="#course1" class="course-card-body">
                                <div class="course-card-title">
                                    <h2>Course 1</h2>
                                </div>
                                <div class="course-card-subtitle">PHP, JS, CSS3, HTML5</div>
                            </a>
                        </div>
                        <div class="course-card">
                            <div class="course-card-thumbnail">
                                <img src="/Images/course-2.jpg" alt="Course 2" title="Course 2">
                            </div>
                            <a href="#course1" class="course-card-body">
                                <div class="course-card-title">
                                    <h2>Course 2</h2>
                                </div>
                                <div class="course-card-subtitle">Database, SQL, MySQL</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>