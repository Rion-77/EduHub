<?php
class UserAttempt
{
    static public function readById($_id)
    {
        global $db;
        $sql = "SELECT id, quiz_id, user_quiz_score, quiz_score, attempt_at FROM user_quiz_attempts WHERE user_id = $_id";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    
}
    