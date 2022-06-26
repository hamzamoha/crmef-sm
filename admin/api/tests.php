<?php
require_once(__DIR__ . "/../../Includes/Functions.php");
require_once(__DIR__ . "/../../Includes/Models/Tests.php");
require_once(__DIR__ . "/../../Includes/Models/Questions.php");
require_once(__DIR__ . "/../../Includes/Models/Options.php");
require_once(__DIR__ . "/../../Includes/Models/Answers.php");
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['_method'])) {
    if ($_POST['_method'] == "create") {
        $test = Tests::insert([
            "title" => $_POST['title'],
            "description" => $_POST['description']
        ]);
        if ($test) {
            $test->date = (new DateTime($test->date))->format("jS F Y");
            die(message("success", $test));
        } else {
            die(message("error", "Error While Modifying the Test"));
        }
    }
    if ($_POST['_method'] == "update") {
        $test = Tests::get($_POST['id']);
        $bool = $test->update([
            "title" => $_POST['title'],
            "description" => $_POST['description']
        ]);
        if ($bool) {
            $test->date = (new DateTime($test->date))->format("jS F Y");
            die(message("success", $test));
        } else {
            die(message("error", "Error While Adding the Test"));
        }
    }
    if ($_POST['_method'] == "delete") {
        $ids = $_POST['tests-ids'];
        $bool = Tests::delete("id in ($ids)");
        $bool = Questions::delete("test_id in ($ids)");
        $bool = Options::delete("question_id not in (SELECT id FROM questions)");
        $bool = Answers::delete("test_id in ($ids)");
        if ($bool) {
            die(message("success", "Deleted successfuly !"));
        } else {
            die(message("error", "Error While Deleting the test"));
        }
    }
    if ($_POST['_method'] == "truncate") {
        Tests::truncate();
        Questions::truncate();
        Options::truncate();
        Answers::truncate();
    }
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

header("Location: /");
