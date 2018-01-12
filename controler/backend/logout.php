<?php

require_once '../controler/backend/Session.php';

function logout()
{
    $session = Session::getInstance();

    if ($session->__isset('auth')) {
        $session->destroy();
        listPosts();
    } else {
        listPosts();
    }
}