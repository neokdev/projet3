<?php

namespace Neok\projet3\model;

require_once 'model/Manager.php';

class AdminManager extends Manager
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