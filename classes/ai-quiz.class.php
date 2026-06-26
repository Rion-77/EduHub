<?php

class AIQuiz {
    public $id;
    public $quiz_name;
    public $quiz_category_id;
    public $description;
    public $time_limit;
    public $score;
    public $creator_id;

    function __construct(
        $_id,
        $_quiz_name,
        $_quiz_category_id,
        $_description,
        $_time_limit,
        $_score,
        $_creator_id
    ) {
        $this->id = $_id;
        $this->quiz_name = $_quiz_name;
        $this->quiz_category_id = $_quiz_category_id;
        $this->description = $_description;
        $this->time_limit = $_time_limit;
        $this->score = $_score;
        $this->creator_id = $_creator_id;
    }

    // Creates Quiz
    public function createQuiz()
    {
        global $db;
        $sql = "INSERT INTO quizzes (quiz_name, quiz_category_id, description, time_limit, score) VALUES ('{$db->real_escape_string($this->quiz_name)}', $this->quiz_category_id,'$this->description','$this->time_limit',$this->score )";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return $db->insert_id;
        }
    }

    // Creates Question
    public function createQuestion($question, $quiz_id, $question_type_id)
    {
        global $db;
        $sql = "INSERT INTO questions (question, quiz_id, question_type_id) VALUES ('{$db->real_escape_string($question)}', $quiz_id, $question_type_id)";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return $db->insert_id;
        }
    }

    // Creates Options
    public function createOption($_option_text, $_question_id, $_is_correct)
    {
        global $db;
        $sql = "INSERT INTO question_options (option_text, question_id, is_correct) VALUES ('{$db->real_escape_string($_option_text)}', {$_question_id}, {$_is_correct})";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }
}
