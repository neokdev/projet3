<?php

require_once '../../model/backend/AdminManager.php';

try{
    if (isset($_POST['submit'])) {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
        } 
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        } 
        if (isset($_POST['password'])) {
            $passwordEntered = sha1($_POST['password']);
        } 
        if (isset($_POST['remember'])) {
            $remember = "true";
        } else {
            $remember = "false";
        } 
    } else {
        throw new \Exception("Erreur de saisie");
    }
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    include 'views/errorView.php';
    include 'views/nav.php';
    include 'views/template.php';
}

$adminmanager = new AdminManager;
$user = $adminmanager->auth($email);
$password = $user[0]->password;
if ($passwordEntered === $password) {
    $_SESSION['auth'] = $user[0]->id;
    dir('Connecté');
} else {
    die('Pas connecté');
}




echo "user : " . $username . "    ";
echo "email : " . $email . "    ";
echo "password : " . $password . "    ";
echo "password entered : " . $passwordEntered . "    ";
echo "remember : " . $remember . "    ";