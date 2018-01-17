<?php

require_once '../controler/backend/Session.php';

function logout()
{
    $session = Session::getInstance();

    if ($session->__isset('auth')) {
        $session->destroy();
        $message = "<div class=\"alert alert-info text-center\" role=\"success\">Vous êtes déconnecté</div>";
        getPosts($message);
    } else {
        $message = "<div class=\"alert alert-danger text-center\" role=\"success\"><strong>Erreur !</strong> Impossible de se déconnecter</div>";
        getPosts($message);
    }
}