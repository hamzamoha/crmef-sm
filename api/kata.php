<?php
require_once(__DIR__ . "/../Includes/Functions.php");
require_once(__DIR__ . "/../Includes/Models/Kata.php");

if (!is_logged_in()) die(message("info", "You don't have access to this page"));

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['_method'])) {
    if ($_POST['_method'] == "create") {
        $student_id = student()->id;
        $kata_id = $_POST["id"];
        $code = $_POST["code"];
        file_put_contents(__DIR__ . "/../kata-codes/kata${kata_id}_student${student_id}", $code);
        die(message("success", "The answers has been saved successfuly !"));
    }
}
header("location: /");
