<?php
class CourseCategory {

    public $id;
    public $name;
    public $description;
    public $parent_id;

    function __construct($_id, $_name, $_description, $_parent_id)
    {
        $this->id = $_id;
        $this->name = $_name;
        $this->description = $_description;
        $this->parent_id = $_parent_id;
    }

    public function create()
    {
        global $db;
        $sql = "INSERT INTO quiz_category (name, description) VALUES ('$this->name', '$this->description')";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }
    
    static public function readAll() {
        global $db; 
        $sql = "SELECT * FROM quiz_category ORDER BY name ASC";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

     static public function readById($_id)
    {
        global $db;
        $sql = "SELECT * FROM quiz_category WHERE id = $_id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    public function update()
    {
        global $db;
        $sql = "UPDATE quiz_category SET name = '$this->name', description = '$this->description' WHERE id = $this->id";
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
        $sql = "DELETE FROM quiz_category WHERE id = $_id";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }
}