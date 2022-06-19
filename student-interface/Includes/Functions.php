<?php

use JetBrains\PhpStorm\ExpectedValues;

function is_logged_in()
{
    return true;
}
function message(#[ExpectedValues("info", "error", "success")] string $type = "info", string $message = "Hello World!"): string
{
    return json_encode([
        "type" => $type,
        "message" => $message
    ]);
}
?>