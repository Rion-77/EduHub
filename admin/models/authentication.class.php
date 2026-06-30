<?php
class Authentication
{

    static public function login($email, $password)
    {
        global $db;
        $sql = "SELECT u.*, ur.name role_name FROM users u, user_roles ur WHERE email= '$email'";
        $result = $db->query($sql);

        $user_info =$result->fetch_assoc();
        if (empty($user_info)) {
            return ["email_error" => "Email not found"];
        } elseif(!password_verify($password, $user_info['password'])) {
           return ["password_error" => "Passoword is incorrect"];
        } else {
            unset($user_info["password"]);
            return $user_info;
        }
        // return $result->fetch_assoc();
    }
}
