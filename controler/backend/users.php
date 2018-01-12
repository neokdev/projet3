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
}