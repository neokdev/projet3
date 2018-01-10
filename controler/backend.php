<?php

use Neok\projet3\model\AdminManager;

require_once '../model/backend/AdminManager.php';

function login() 
{
    $adminManager = new AdminManager();

    include '../views/backend/login.php';
    include '../views/nav.php';
    include '../views/template.php';
}