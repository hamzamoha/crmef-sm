<?php

require_once(__DIR__ . "/../../Includes/Models/Questions.php");
require_once(__DIR__ . "/../../Includes/Models/Options.php");
require_once(__DIR__ . "/../../Includes/Functions.php");

if (isset($_POST['action']) && $_POST['action'] == "get") {
    $test_id = intval($_POST['test_id']);

    $data = [];

    $questions = Questions::select("test_id=$test_id", "1", "ASC");

    foreach ($questions as $question) {
        $question = [
            "statement" => $question,
            "options" => Options::select("question_id=$question->id", "1", "ASC")
        ];
        array_push($data, $question);
    }

    die(json_encode($data));
}
if (isset($_POST['action']) && $_POST['action'] == "create") {
    $test_id = $_POST['test-id'];
    $question = base64_decode($_POST['question']);
    $s = Questions::insert([
        "test_id" => $test_id,
        "question" => $question,
        "score" => 1
    ]);
    if ($s) die(message("success", $s));
    else die(message("error", "Error While Adding the Question, Please Contact the Administrator"));
}
if (isset($_POST['action']) && $_POST['action'] == "update") {
    $question_id = intval($_POST['id']);

    $dataArray = [];
    isset($_POST['statement']) && $dataArray["question"] = ($_POST['statement']);
    isset($_POST['score']) && $dataArray["score"] = ($_POST['score']);
    if (count($dataArray) > 0) Questions::update($question_id, $dataArray);
    $question = Questions::get($question_id);
    if ($question) die(json_encode($question));
    else die(message("error", "Question not found !"));
}
if (isset($_POST['action']) && $_POST['action'] == "delete") {
    $question_id = intval($_POST['id']);

    $question = Questions::get($question_id);

    if ($question) {
        $s = $question->delete();
        if ($s) {
            Options::delete("question_id = $question_id");
            die(json_encode($question));
        } else die(message("error", "Erorr While Deleting the question !"));
    } else die(message("error", "Question not found !"));
}

header("location: http://" . $_SERVER['HTTP_HOST'] . "/");
