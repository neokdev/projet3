<?php

use Neok\projet3\model\AdminManager;

require_once '../model/backend/AdminManager.php';

function login($username, $email, $password, $remember) 
{
    $adminManager = new AdminManager();
    $info = $adminManager->getUserInfo($username, $email, $password, $remember);

    include '../view/backend/login.php';
}