<?php

require_once '../model/backend/AdminManager.php';
require_once '../controler/backend/Session.php';

function submitLogin($email, $password)
{
    if (isset($_POST['password'])) {
        $password = $_POST['password'];;
    } 
    if (isset($_POST['remember'])) {
        $remember = "true";
    } else {
        $remember = "false";
    } 
     
    $adminmanager = new AdminManager;
    $user = $adminmanager->auth($email);
    $passworddb = $user[0]->password;
    $userid = $user[0]->id;
    $emaildb = $user[0]->email;
    $date = $user[0]->creation_date;
    if (password_verify($password, $passworddb)) {
        $session = Session::GetInstance();
        $session->startSession();
        $session->auth = true;
        $session->id = $userid;
        $session->email = $email;
        $session->date = $date;
        listPosts();
    } else {
        die('Pas connecté');
        
    }
}