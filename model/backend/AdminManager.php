<?php
require_once '../src/Projet3/Database/Database.php';

class AdminManager extends Database
{
    public function selectAuth(string $email)
    {
        $db = $this->dbConnect();
        $authReq = $db->query(
            "SELECT *
            FROM users
            WHERE email = '$email'"
        );
        $auth = $authReq->fetchAll(\PDO::FETCH_OBJ);
        
        return $auth;
    }
}