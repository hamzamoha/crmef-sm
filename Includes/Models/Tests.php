<?php

require_once(__DIR__ . "/../Functions.php");
require_once(__DIR__ . "/../Table.php");
require_once(__DIR__ . "/Answers.php");
require_once(__DIR__ . "/Questions.php");

class Tests extends Table
{
    protected static $table = "tests";

    public static function is_passed(int $test_id)
    {
        return Answers::count("test_id=$test_id AND student_id=" . student()->id) > 0;
    }

    /**
     * 
     * Return the score of a student in a test
     * 
     */
    public static function score(int $test_id): int
    {
        if(Tests::is_passed($test_id)){
            $answers = Answers::select("test_id=$test_id AND student_id=" . student()->id);
            $score = 0;
            foreach($answers as $answer){
                if(Answers::is_right($answer->question_id)){
                    $question = Questions::get($answer->question_id);
                    $score += intval($question->score);
                }
            }
            return $score;
        }
    }
}
