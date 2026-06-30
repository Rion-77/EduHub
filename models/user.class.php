<?php
class User
{
    public $id;
    public $name;
    public $email;
    public $role_id;
    private $password;
    public $user_picture_link;

    function __construct($_id, $_name, $_email,  $_role_id, $_password = null, $_user_picture_link = null)
    {
        $this->id = $_id;
        $this->name = $_name;
        $this->email = $_email;
        $this->role_id = $_role_id;
        $this->password = $_password;
        $this->user_picture_link = $_user_picture_link;
    }

    public function create()
    {
        global $db;
        $sql = "INSERT INTO users (name, email, password, user_role, user_picture_link) VALUES ('$this->name', '$this->email','$this->password',$this->role_id,'$this->user_picture_link')";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    static public function readAll()
    {
        global $db;
        $sql = "SELECT u.id,u.name ,u.email,ur.name role, u.user_picture_link FROM users u, user_roles ur WHERE u.user_role = ur.id";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    static public function readById($_id)
    {
        global $db;
        $sql = "SELECT u.id,u.name ,u.email,u.user_role role, ur.name role_name, u.user_picture_link FROM users u, user_roles ur WHERE u.id = $_id AND u.user_role = ur.id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    public function update()
    {
        global $db;
        $sql = "UPDATE users SET name = '$this->name', email = '$this->email', user_role = $this->role_id WHERE id = $this->id";
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
        $sql = "DELETE FROM users WHERE id = $_id";
        $db->query($sql);
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }
}
