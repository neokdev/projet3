<?php

require_once '../model/backend/AdminManager.php';

class User 
{
    public function getAuth()
    {
        if (isset($_GET['err'])) {
            if ($_GET['err'] == 'nomail') {
                $errorMessage = "<div class=\"alert alert-danger text-center\" role=\"alert\"><strong>Erreur ! </strong>Le mail n'est pas dans la base de donnée</div>";
            } elseif ($_GET['err'] == 'wrongpass') {
                $errorMessage =  "<div class=\"alert alert-danger text-center\" role=\"alert\"><strong>Erreur ! </strong>Le mot de passe n'est pas valide</div>";
            }
        }

        include '../views/backend/login.php';
        include '../views/nav.php';
        include '../views/template.php';
    }
}