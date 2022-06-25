<?php
require_once(__DIR__ . "/../../Includes/Functions.php");
require_once(__DIR__ . "/../../Includes/Models/Tests.php");
require_once(__DIR__ . "/../../Includes/Models/Questions.php");
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['_method'])) {
    if ($_POST['_method'] == "create") {
        $test = Tests::insert([
            "title" => $_POST['title'],
            "description" => $_POST['description']
        ]);
        if ($test) {
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
            die(message("success", $test));
        } else {
            die(message("error", "Error While Adding the Test"));
        }
    }
    if ($_POST['_method'] == "delete") {
        $ids = $_POST['tests-ids'];
        Tests::delete("id in ($ids)");
    }
    if ($_POST['_method'] == "truncate") {
        Tests::truncate();
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
