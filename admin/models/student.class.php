<?php
require_once "user.class.php";

class Student extends User {
    static public function readAll()
    {
        global $db;
        $sql = "SELECT u.id,u.name ,u.email,ur.name role, u.user_picture_link FROM users u, user_roles ur WHERE u.user_role = ur.id AND u.user_role = 3";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

