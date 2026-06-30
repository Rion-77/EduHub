<?php
class Quiz
{
    public $id;
    public $quiz_name;
    public $quiz_category_id;
    public $description;
    public $time_limit;
    public $score;
    public $creator_id;

    function __construct(
    $_id, 
    $_quiz_name, $_quiz_category_id,
    $_description,
    $_time_limit,
    $_score,
    $_creator_id)
    {
        $this->id = $_id;
        $this->quiz_name = $_quiz_name;
        $this->quiz_category_id = $_quiz_category_id;
        $this->description = $_description;
        $this->time_limit = $_time_limit;
        $this->score = $_score;
        $this->creator_id = $_creator_id;
    }

    public function create()
    {
        global $db;
        $sql = "INSERT INTO quizzes (quiz_name, quiz_category_id, description, time_limit, score) VALUES ('$this->quiz_name', $this->quiz_category_id,'$this->description','$this->time_limit',$this->score )";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    static public function readAll($page_no = 1 ,$display_item = 10)
    {
        $limit = ($page_no - 1) * $display_item;
        global $db;
        $sql = "SELECT 
        q.id, 
        q.quiz_name, 
        qc.name category, 
        q.description, 
        q.time_limit, 
        q.score
        FROM quizzes q, quiz_category qc 
        WHERE q.quiz_category_id = qc.id ORDER BY q.id DESC LIMIT $display_item OFFSET $limit";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    static public function readById($_id)
    {
        global $db;
        $sql = "SELECT 
        id, 
        quiz_name, 
        quiz_category_id, 
        description, 
        time_limit, 
        score
        FROM quizzes
        WHERE id = $_id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    public function update()
    {
        global $db;
        $sql = "UPDATE quizzes SET 
        quiz_name = '$this->quiz_name', 
        quiz_category_id = $this->quiz_category_id, 
        description = '$this->description', 
        time_limit = '$this->time_limit', 
        score = $this->score
        WHERE id = $this->id";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

     static public function delete($_id)
    {
        global $db;
        $sql = "DELETE FROM quizzes WHERE id = $_id";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }
    // For Pagination
    static public function numberOfPage($display_item)
    {
        global $db;
        $sql = "SELECT count(id) total
        FROM quizzes";
        $result = $db->query($sql);
        $rows = $result->fetch_assoc();
        return ceil($rows['total']/$display_item);
    }

}
