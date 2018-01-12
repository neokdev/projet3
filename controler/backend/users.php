<?php

require_once '../model/backend/AdminManager.php';

class User 
{

    public function getAuth()
    {
        include '../views/backend/login.php';
        include '../views/nav.php';
        include '../views/template.php';
    }

    public function logged(){
        return isset($_SESSION['auth']);
    }

    public function getUserInfo(): array
    {  
        $userInfo['id'] = $_SESSION['id'];
        $userInfo['email'] = $_SESSION['email'];
        $userInfo['date'] = $_SESSION['date'];

        return $userInfo;
    }
}