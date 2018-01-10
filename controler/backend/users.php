<?php
namespace Neok\Projet3\Controler;

use Neok\Projet3\Model\AdminManager;

require_once '../model/backend/AdminManager.php';

class UsersControler
{
    public function login() 
    {
        $adminManager = new AdminManager();

        include '../views/backend/login.php';
        include '../views/nav.php';
        include '../views/template.php';
    }
}
