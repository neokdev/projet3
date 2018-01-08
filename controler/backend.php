<?php
use Neok\projet3\model\AdminManager;
require_once 'model/AdminManager.php';
function submitLogin() 
{
    $adminManager = new AdminManager();
    $username = $adminManager->getUserInfo($_POST['username']);
}
function login()
{
    include 'view/backend/login.php';
}