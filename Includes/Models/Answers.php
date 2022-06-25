<?php

require_once(__DIR__ . "/../Table.php");
require_once(__DIR__ . "/../Functions.php");

class Answers extends Table
{
    protected static $table = "answers";

    public static function is_right(int $question_id)
    {
        $rightAnswers = "SELECT id AS ra_id FROM options WHERE question_id=$question_id AND correct=1";
        $suggestedAnswers = "SELECT option_id AS sa_id FROM answers WHERE question_id=$question_id AND student_id=" . student()->id;
        $countRightAnswers = "SELECT COUNT(*) AS count_ra FROM ($rightAnswers) AS rightAnswers WHERE rightAnswers.ra_id NOT IN ($suggestedAnswers)";
        $countSuggestedAnswers = "SELECT COUNT(*) AS count_sa FROM ($suggestedAnswers) AS suggestedAnswers WHERE suggestedAnswers.sa_id NOT IN ($rightAnswers)";
        $is_right = "SELECT COUNT(*) AS is_right FROM ($countRightAnswers) AS ra_t, ($countSuggestedAnswers) AS sa_t WHERE count_ra = count_sa AND count_ra = 0";
        $db = Database::connect();
        $res = $db->query($is_right);
        $res = $res->fetch_array();
        return (intval($res["is_right"]) == 1);
    }
}
