<?php

require_once '../model/backend/AdminManager.php';
require_once '../controler/backend/Session.php';

function showLogin(string $message = null): void
{
    include '../views/backend/login.php';
    include '../views/nav.php';
    include '../views/template.php';
}
function login(string $email, string $password, bool $remember)
{
    $adminmanager = new AdminManager;
    $user = $adminmanager->selectAuth($email);
    if (!empty($user)) {
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
            $message = "<div class=\"alert alert-info text-center\" role=\"success\">Connecté depuis l'adresse : $session->email</div>";
            getPosts($message);
        } else {
            $message = "<div class=\"alert alert-danger text-center\" role=\"success\"><strong>Erreur !</strong> Le mot de passe est incorrect</div>";
            showLogin($message);
        }
    } else {
        $message = "<div class=\"alert alert-danger text-center\" role=\"success\"><strong>Erreur !</strong> Cet email n'est pas dans la base de données</div>";
        showLogin($message);
    }
}