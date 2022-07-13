<?php

require_once(__DIR__ . "/../Table.php");

class Kata extends Table
{
    protected static $table = "katas";

    public static function is_solved(int $id)
    {
        $kata = Kata::get($id);
        if ($kata) {
            return self::solve($kata);
        } else return false;
    }

    private static function solve(object $kata = null)
    {
        if (!$kata) return false;
        if ($kata->language == "php") {
            $student_id = student()->id;
            $dir = __DIR__ . "/../../kata-testers/testers";
            $out = shell_exec("cd $dir; php tester.php \"../{$kata->tester}\" \"../../kata-codes/kata{$kata->id}_student$student_id\" 2>&1");
            return ($out == 1);
        }
        if ($kata->language == "javascript") {
            $student_id = student()->id;
            $dir = __DIR__ . "/../../kata-testers/testers";
            $out = shell_exec("cd $dir; node tester.js \"../{$kata->tester}\" \"../../kata-codes/kata{$kata->id}_student$student_id\" 2>&1");
            return ($out);
        }
        if ($kata->language == "python") {
            $student_id = student()->id;
            $dir = __DIR__ . "/../../kata-testers/testers";
            //python kata-testers/testers/tester.py "./kata-testers/Return 5.py" "./kata-codes/kata3_student1"
            $out = shell_exec("cd $dir; python tester.py \"../{$kata->tester}\" \"../../kata-codes/kata{$kata->id}_student$student_id\" 2>&1");
            return ($out == 1);
        }
        return false;
    }
}
