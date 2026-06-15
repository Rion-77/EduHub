<?php
class Role {
    static public function readAll() {
        global $db; 
        $sql = "SELECT * FROM user_roles";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}