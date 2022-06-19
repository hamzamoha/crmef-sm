<?php
require_once(__DIR__ . "/../student-interface/Includes/Models/Tests.php");
require_once(__DIR__ . "/../student-interface/Includes/Models/Courses.php");
require_once(__DIR__ . "/../student-interface/Includes/Functions.php");
require_once(__DIR__ . "/../student-interface/Includes/Models/Questions.php");
if (isset($_POST['add-test'])) {
    Tests::insert([
        "title" => $_POST['title'],
        "description" => $_POST['description']
    ]);
}
if (isset($_POST['modify-test'])) {
    Tests::update($_POST['id'], [
        "title" => $_POST['title'],
        "description" => $_POST['description']
    ]);
}
if (isset($_POST['delete-tests'])) {
    $ids = $_POST['tests-ids'];
    Tests::delete("id in ($ids)");
}
if (isset($_POST['delete-all-tests'])) {
    Tests::truncate();
}
if (isset($_POST['add-question'])) {
    $test_id = $_POST['test-id'];
    $question = base64_decode($_POST['question']);
    $s = Questions::insert([
        "test_id" => $test_id,
        "question" => $question,
        "score" => 1
    ]);
    if ($s) echo json_encode($s);
    else return message("error", "Error While Adding the Question, Please Contact the Administrator");
    die();
}
$tests = Tests::select();
$courses = Courses::select();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/FontAwesome6/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
    <script src="/script/jquery.min.js"></script>
    <script src="/script/script.js"></script>
</head>

<body>
    <?php
    if (is_logged_in()) {
    ?>
        <div class="dashboard">
            <div class="dashboard-sidebar">
                <a href="#" class="sidebar-link" data-target="#main">Home</a>
                <a href="#" class="sidebar-link" data-target="#tests">Tests</a>
                <a href="#" class="sidebar-link" data-target="#courses">Courses</a>
                <a href="#" class="sidebar-link" data-target="#">...</a>
            </div>
            <div class="dashboard-content">
                <div class="main" data-label="#main" style="display: none;">
                    Welcome
                </div>
                <?php include(__DIR__ . "/includes/tests.php"); ?>
                <?php include(__DIR__ . "/includes/courses.php"); ?>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="login">
            <div class="login-box">
                <img src="/imgs/icon.jpg" alt="" class="login-icon">
                <h1 class="login-title">Login</h1>
                <form method="POST" class="login-form" autocomplete="off">
                    <input type="text" id="username" name="username" placeholder="Username">
                    <input type="password" id="password" name="password" placeholder="Password">
                    <input type="submit" value="Login" name="login" id="login">
                </form>
                <hr class="hr">
                <div class="login-help">
                    <a href="">Finding a problem ?</a>
                </div>
            </div>
        </div>
    <?php
    } ?>
</body>

</html>