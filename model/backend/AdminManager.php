<?php
require_once '../src/Projet3/Database/Database.php';

class AdminManager extends Database
{
    public function auth($email)
    {
        $db = $this->dbConnect();
        $res = $db->query(
            "SELECT *
            FROM users
            WHERE email = '$email'"
        );
        $user = $res->fetchAll(\PDO::FETCH_OBJ);
        
        return $user;
    }
}