<?php
require_once(__DIR__ . "/../../Includes/Functions.php");
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['_method'])) {
    if ($_POST['_method'] == "get") {
        $language = $_POST['language'];
        if (file_exists(__DIR__ . "/../../kata-testers/snippets/$language"))
            die(message("success", file_get_contents(__DIR__ . "/../../kata-testers/snippets/$language")));
        else
            die(message("error", "Snippet not found !"));
    }
}
header("location: http://" . $_SERVER['HTTP_HOST'] . "/");
