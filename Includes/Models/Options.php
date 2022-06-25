<?php

require_once(__DIR__ . "/../Functions.php");
require_once(__DIR__ . "/../Table.php");

class Options extends Table
{
    protected static $table = "options";

    public static function is_answer(int $option_id)
    {
        return (Answers::count("option_id=$option_id AND student_id=" . student()->id) == 1);
    }
}
