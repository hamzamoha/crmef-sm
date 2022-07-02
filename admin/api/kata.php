<?php
require_once(__DIR__ . "/../../Includes/Functions.php");
require_once(__DIR__ . "/../../Includes/Models/Kata.php");
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['_method'])) {
    if ($_POST['_method'] == "create") {
        $kata = [
            "title" => $_POST["title"],
            "description" => $_POST["description"],
            "language" => $_POST["language"],
        ];
        $tester = (object) [
            "script" => $_POST["tester"],
            "filename" => preg_replace("/\s+/", " ", $kata['title']),
            "language" => $kata['language']
        ];
        $ext = language_to_ext($tester->language);
        if ($ext) {
            $folder_to_upload = __DIR__ . "/../../kata-testers/";
            $c = 0;
            $filename = $tester->filename;
            while (file_exists($folder_to_upload . $filename . ".$ext") && $c++)
                $filename = $tester->filename . $c;
            $tester->filename = $filename . ".$ext";
            $bool = file_put_contents(__DIR__ . "/../../kata-testers/" . $tester->filename, $tester->script);
            if(!$bool) die(message("error", "Error while creating kata's tester file !"));
            $kata["tester"] = $tester->filename;
            $kata = Kata::insert($kata);
            if(!$kata) die(message("error", "Error while creating kata !"));
            die(message("success", $kata));
        }
        else {
            die(message("error", "Error while finding kata's language !"));
        }
    }
}
header("location: http://" . $_SERVER['HTTP_HOST'] . "/");
