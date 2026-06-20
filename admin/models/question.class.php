<?php

class Questions
{
    public $id;
    public $question;
    public $quiz_id;
    public $question_type_id;

    function __construct($_id, $_question, $_quiz_id, $_question_type_id)
    {
        $this->id = $_id;
        $this->question = $_question;
        $this->quiz_id = $_quiz_id;
        $this->question_type_id = $_question_type_id;
    }

    /* ─── CREATE ─────────────────────────── */
    public function createQuestion()
    {
        global $db;
        $sql = "INSERT INTO questions (question, quiz_id, question_type_id) VALUES ('$this->question', $this->quiz_id, $this->question_type_id)";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    public function createOption($_option_text, $_question_id, $_is_correct)
    {
        global $db;
        $sql = "INSERT INTO question_options (option_text, question_id, is_correct) VALUES ('$_option_text', $_question_id, $_is_correct)";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    /* ─── UPDATE ─────────────────────────── */
    public function updateQuestion()
    {
        global $db;
        $sql = "UPDATE questions SET 
                question = '$this->question',
                quiz_id = $this->quiz_id,
                question_type_id = $this->question_type_id 
                WHERE id = $this->id";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    public function updateOption($_option_id, $_option_text, $_is_correct)
    {
        global $db;
        $sql = "UPDATE question_options SET 
                option_text = '$_option_text',
                is_correct = $_is_correct 
                WHERE id = $_option_id";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    /* ─── DELETE ─────────────────────────── */
    /**
     * Delete a question and all its options.
     * @param int $_question_id
     * @return true|string True on success, error message on failure.
     */
    static public function deleteQuestion($_question_id)
    {
        global $db;
        $_question_id = (int)$_question_id;

        // Delete options first (if foreign keys exist, this order avoids errors)
        $sql1 = "DELETE FROM question_options WHERE question_id = $_question_id";
        $db->query($sql1);
        if ($db->error) {
            return $db->error;
        }

        // Delete the question itself
        $sql2 = "DELETE FROM questions WHERE id = $_question_id";
        $db->query($sql2);
        if ($db->error) {
            return $db->error;
        }

        return true;
    }

    /* ─── READ ───────────────────────────── */
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

    static public function questionById($question_id)
    {
        global $db;
        $q_sql = "SELECT * FROM questions WHERE id = " . (int)$question_id;
        $q_result = $db->query($q_sql);
        return $q_result ? $q_result->fetch_assoc() : null;
    }
}