<?php

use JetBrains\PhpStorm\ExpectedValues;

function is_logged_in()
{
    return true;
}
/**
 * 
 * Return a json message could be of type "info", "error" or "success"
 * 
 */
function message(#[ExpectedValues("info", "error", "success")] string $type = "info", $message = "Hello World!"): string
{
    return json_encode([
        "type" => $type,
        "message" => $message
    ]);
}
/**
 * Upload a file
 * 
 * @param object $file file upload array from $_FILES array
 * @param string $path full absolute path of destination folder. It should ends with slash '/'
 * @return string|false name of uploaded file or false
 * 
 */
function upload(array $file, string $path): string|false
{
    $full_path = $path . basename($file['name']);
    $file_part = pathinfo($full_path);
    $i = 0;
    while (file_exists($full_path)) {
        $i++;
        $full_path = $path . $file_part['filename'] . " ($i)." . $file_part['extension'];
    }
    $bool = move_uploaded_file($file['tmp_name'], $full_path);
    if ($bool) return basename($full_path);
    else return false;
}

function student()
{
    return (object) [
        "id" => "1",
        "name" => "",
        "codeMassar" => ""
    ];
}