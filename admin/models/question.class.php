<?php
class Questions
{
    static public function readByQuizId($_quiz_id)
    {
        global $db;
        $sql = "SELECT 
                q.id, 
                question, 
                qt.name as question_type, 
                qo.id as correct_option_id 
                FROM 
                questions AS q, 
                question_types AS qt, 
                question_options AS qo 
                WHERE quiz_id = $_quiz_id 
                AND question_type_id = qt.id
                AND qo.question_id = q.id 
                AND qo.is_correct = 1";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    static public function optionsByQuestionId($_question_id)
    {
        global $db;
        $sql = "SELECT id, option_text, is_correct FROM question_options WHERE question_id = $_question_id";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
