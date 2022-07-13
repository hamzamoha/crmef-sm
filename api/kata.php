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
        $kata = Kata::get($kata_id);
        if ($kata->language == "php") {
            $out = shell_exec("cd ../kata-testers/testers; php tester.php \"../$kata->tester\" \"../../kata-codes/kata${kata_id}_student${student_id}\" 2>&1");
            if ($out == "1")
                die(message("success", "Good Answer"));
            else
                die(message("error", "$out"));
        }
        die(message("error", "no language"));
    }
    if($_POST['_method'] == "get"){
        $kata_id = $_POST['id'];
        $student_id = student()->id;
        $file = "../kata-codes/kata{$kata_id}_student{$student_id}";
        $content = "";
        if(file_exists($file))
            $content = file_get_contents($file);
        die(message("success", $content));
    }
}
header("location: /");
