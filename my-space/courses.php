<?php
require_once(__DIR__ . "/../Includes/Models/Courses.php");

if (isset($_GET['id'])) {
    $course = Courses::get(intval($_GET['id']));
} else {
    $courses = Courses::paginate();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
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
                    <?php if (isset($courses)) { ?>
                        <h1 class="content-title">Courses</h1>
                        <div class="elements-cards">
                            <?php if ($courses) foreach ($courses as $count => $course) { ?>
                                <div class="element-card">
                                    <div class="element-card-thumbnail">
                                        <img src="/courses/images/<?= $course->image; ?>" alt="<?= addslashes($course->title); ?>" title="<?= addslashes($course->title); ?>">
                                    </div>
                                    <a href="?id=<?= $course->id; ?>" class="element-card-body">
                                        <div class="element-card-title">
                                            <h2><?= $course->title; ?></h2>
                                        </div>
                                        <div class="element-card-subtitle"><?= $course->description; ?></div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else if ($course) { ?>
                        <h1 class="content-title">Course: <?= $course->title; ?></h1>
                        <p class="content-description"><?= $course->description; ?></p>
                        <img class="content-thumbnail" src="/courses/images/<?= $course->image; ?>" alt="<?= $course->title; ?>" title="<?= $course->title; ?>">
                        <div class="pdf-download-button">
                            <a href="/courses/pdfs/<?= $course->file; ?>"><i class="fa-regular fa-file-pdf"></i> Download</a>
                        </div>
                        <script src="/JS/pdf.js/pdf.min.js"></script>
                        <div id="pdf-viewer" data-pdf="/courses/pdfs/<?= $course->file; ?>"></div>
                        <div class="pdf-viewer-buttons">
                            <button id="prev-page">prev</button>
                            <div id="page-number">
                                <input type="number">
                            </div>
                            <button id="next-page">next</button>
                        </div>
                        <script async>
                            let input = document.querySelector(".pdf-viewer-buttons #page-number input");
                            let div = document.getElementById("pdf-viewer");
                            let pdf_reader = new PDF_Reader(div, input);
                        </script>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>