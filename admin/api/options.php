<?php

require_once(__DIR__ . "/../../Includes/Models/Options.php");
require_once(__DIR__ . "/../../Includes/Functions.php");

if (isset($_POST['action']) && $_POST['action'] == "create") {
    $option = [
        "phrase" => ($_POST["phrase"]),
        "question_id" => $_POST["question_id"],
        "correct" => $_POST["correct"]
    ];

    $option = Options::insert($option);

    if ($option) die(json_encode($option));
    else die(message("error", "Error while adding the option"));
}

if (isset($_POST['action']) && $_POST['action'] == "update") {
    $id = intval($_POST["id"]);

    $option = [];

    isset($_POST['correct']) && $option["correct"] = ($_POST['correct']);
    isset($_POST['phrase']) && $option["phrase"] = ($_POST['phrase']);

    if (count($option) > 0) Options::update($id, $option);

    $option = Options::get($id);

    if ($option) die(json_encode($option));
    else die(message("error", "Option not found !"));
}

if (isset($_POST['action']) && $_POST['action'] == "delete") {
    $id = intval($_POST["id"]);

    $option = Options::get($id);

    if ($option) {
        if ($option->delete()) die(json_encode($option));
        else die(message("error", "Option not deleted !"));
    } else die(message("error", "Option not found !"));
}

header("location: http://" . $_SERVER['HTTP_HOST'] . "/");
