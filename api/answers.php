<?php
require_once(__DIR__ . "/../Includes/Models/Tests.php");
require_once(__DIR__ . "/../Includes/Models/Answers.php");
require_once(__DIR__ . "/../Includes/Functions.php");

if (!is_logged_in()) die(message("info", "You don't have access to this page"));

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['_method'])) {
    if ($_POST['_method'] == "create") {
        // Get test id
        $test_id = intval($_POST["id"]);
        is_int($test_id) || die(message("error", "Error while finding the exam"));

        $test = $_POST["test"];


        // Check if Test Passed
        if(Tests::is_passed($test_id)) die(message("error", "You already passed this test !"));

        // Remove all old answers 
        Answers::delete("test_id=$test_id");

        foreach ($test as $question_id => $options) {
            // Query to Array
            if ($options == "") continue;
            $options = explode(",", $options);

            foreach ($options as $option_id) {
                $answer = [
                    "student_id" => student()->id,
                    "test_id" => $test_id,
                    "question_id" => $question_id,
                    "option_id" => $option_id,
                ];
                try {
                    Answers::insert($answer);
                } catch (Exception $e) {
                    die(message("error", $e->getMessage()));
                }
            }
        }
        die(message("success", "The answers has been saved successfuly !"));
    }
}
header("location: http://" . $_SERVER['HTTP_HOST'] . "/");
