<?php
require_once(__DIR__ . "/../student-interface/Includes/Models/Tests.php");
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
                <a href="#" class="sidebar-link" data-target="#">...</a>
            </div>
            <div class="dashboard-content">
                <div class="main" data-label="#main" style="display: none;">
                    Welcome
                </div>
                <div class="tests" data-label="#tests">
                    <h1>Tests</h1>
                    <div class="crud-buttons">
                        <button class="btn-green" id="add-test">Add</button>
                        <button class="btn-purple" id="edit-questions-test" disabled>Edit Questions</button>
                        <button class="btn-yellow" id="modify-test" disabled>Modify</button>
                        <button class="btn-red" id="delete-test" disabled>Delete</button>
                        <button class="btn-blue" id="select-all-tests">Select All</button>
                        <button class="btn-gray" id="deselect-all-tests" disabled>Deselect All</button>
                        <button class="btn-red" id="delete-all-tests">Delete All</button>
                    </div>
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($tests != false) foreach ($tests as $count => $t) {
                                $t->date = (new DateTime($t->date))->format("jS F Y");
                            ?>
                                <tr>
                                    <td><input type="checkbox" name="select-test" id="<?= $t->id; ?>"></td>
                                    <td><?= $count + 1; ?></td>
                                    <td><?= $t->date; ?></td>
                                    <td><?= $t->title; ?></td>
                                    <td><?= $t->description; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="prompt" style="display: none;" id="add-test-prompt">
                        <form method="POST" autocomplete="off">
                            <div class="form-title">
                                <h2>Add a Test</h2>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" placeholder="Description">
                            </div>
                            <div class="form-group text-center">
                                <input type="button" name="cancel" id="cancel" value="Cancel">
                                <input type="reset" name="reset" id="reset" value="Reset">
                                <input type="submit" name="add-test" id="add-test" value="Add" class="btn-green">
                            </div>
                        </form>
                    </div>
                    <div class="prompt" style="display: none;" id="modify-test-prompt">
                        <form method="POST" autocomplete="off">
                            <div class="form-title">
                                <h2>Modify a Test</h2>
                            </div>
                            <div class="from-group">
                                <h4>Date: <span id="test-date"></span></h4>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" placeholder="Description">
                            </div>
                            <div class="form-group text-center">
                                <input type="hidden" name="id" id="id" value="">
                                <input type="button" name="cancel" id="cancel" value="Cancel">
                                <input type="submit" name="modify-test" id="modify-test" value="Modify" class="btn-green">
                            </div>
                        </form>
                    </div>
                    <div class="prompt" style="display: none;" id="delete-tests-prompt">
                        <form method="POST" autocomplete="off">
                            <div class="form-title">
                                <h2>You Sure You Wanna Delete <span id="tests-count"></span></h2>
                            </div>
                            <h4>There's no comming back !!</h4>
                            <div class="form-group text-center">
                                <input type="hidden" value="" name="tests-ids" id="tests-ids">
                                <input type="button" name="cancel" id="cancel" value="Cancel">
                                <input type="submit" name="delete-tests" id="delete-tests" value="Delete" class="btn-red">
                            </div>
                        </form>
                    </div>
                    <div class="prompt" style="display: none;" id="delete-all-tests-prompt">
                        <form method="POST" autocomplete="off">
                            <div class="form-title">
                                <h2>You Sure You Wanna Delete <span class="color-red">All Tests</span> ?</h2>
                            </div>
                            <h4>There's no comming back !!</h4>
                            <div class="form-group text-center">
                                <input type="button" name="cancel" id="cancel" value="Cancel">
                                <input type="submit" name="delete-all-tests" id="delete-all-tests" value="Delete" class="btn-red">
                            </div>
                        </form>
                    </div>
                    <div class="prompt" style="display: none;" id="questions-test-prompt">
                        <div class="test-questions">
                            <div class="questions-buttons">
                                <button id="close-questions" class="icon-button"><i class="fa-solid fa-x"></i></button>
                                <button id="zoom-questions" class="icon-button"><i class="fa-regular fa-window-maximize"></i></button>
                            </div>
                            <div class="questions-list">
                                <div class="new-question">
                                    <form action="#" method="POST" autocomplete="off" name="new-question-form">
                                        <input type="hidden" name="test-id" id="test-id" value="">
                                        <input type="text" name="question" id="question" placeholder="Type your question here ...">
                                        <div class="dir-rtl">
                                            <input class="btn-green" type="submit" value="Add Question">
                                        </div>
                                    </form>
                                </div>
                                <div class="questions-items">
                                    <div class="question-item">
                                        <h4 class="question-statement">Question1</h4>
                                        <div class="options">
                                            <h5 class="question-option"><input type="checkbox" name="question1" id="resp1"> Resp 1</h5>
                                            <h5 class="question-option"><input type="checkbox" name="question1" id="resp2"> Resp 2</h5>
                                            <h5 class="question-option"><input type="checkbox" name="question1" id="resp3"> Resp 3</h5>
                                            <h5 class="question-option"><input type="checkbox" name="question1" id="resp4"> Resp 4</h5>
                                        </div>
                                        <div class="question-actions">
                                            <button class="question-action" data-action="delete-question">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                            <button class="question-action" data-action="add-option">
                                                <i class="fa-regular fa-square-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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