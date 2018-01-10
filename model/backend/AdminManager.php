<?php

namespace Neok\Projet3\Model;

require_once '../src/Projet3/DatabaseManager.php';

class AdminManager extends DatabaseManager
{
    public function getUserInfo($username, $email, $password, $remember)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(
            'SELECT *
            FROM users
            WHERE email = ?'
        );
    }
}