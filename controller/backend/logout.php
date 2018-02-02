<?php

require_once '../controller/backend/Session.php';

function logout()
{
    $session = Session::getInstance();

    if ($session->__isset('auth')) {
        $session->destroy();
        $message = "<div class=\"alert alert-info alert-dismissible text-center\" role=\"success\">Vous êtes déconnecté<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button></div>";
        getPosts($message);
    } else {
        $message = "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"success\"><strong>Erreur !</strong> Impossible de se déconnecter<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button></div>";
        getPosts($message);
    }
}