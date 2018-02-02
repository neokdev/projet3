<?php

require_once '../model/backend/AdminManager.php';
require_once '../controller/backend/Session.php';

function showLogin(string $message = null): void
{
    include '../views/backend/login.php';
    include '../views/nav.php';
    include '../views/template.php';
}
function login(string $email, string $password)
{
    $adminmanager = new AdminManager;
    $user = $adminmanager->selectUser($email);
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
            $message = "<div class=\"alert alert-info alert-dismissible text-center\" role=\"success\">Connecté depuis l'adresse : $session->email<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button></div>";
            getPosts($message);
        } else {
            $message = "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"success\"><strong>Erreur !</strong> Le mot de passe est incorrect<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button></div>";
            showLogin($message);
        }
    } else {
        $message = "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"success\"><strong>Erreur !</strong> Cet email n'est pas dans la base de données<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button></div>";
        showLogin($message);
    }
}