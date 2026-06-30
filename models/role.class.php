<?php
class Role {

    public $id;
    public $name;

    function __construct($_id, $_name)
    {
        $this->id = $_id;
        $this->name = $_name;
    }

    public function create()
    {
        global $db;
        $sql = "INSERT INTO user_roles (name) VALUES ('$this->name')";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }
    
    static public function readAll() {
        global $db; 
        $sql = "SELECT * FROM user_roles ORDER BY name ASC";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

     static public function readById($_id)
    {
        global $db;
        $sql = "SELECT * FROM user_roles WHERE id = $_id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    public function update()
    {
        global $db;
        $sql = "UPDATE user_roles SET name = '$this->name' WHERE id = $this->id";
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
        $sql = "DELETE FROM user_roles WHERE id = $_id";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }
}