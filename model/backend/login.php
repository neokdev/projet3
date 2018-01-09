<?php
namespace Neok\projet3\model;

try {
    if (isset($_POST['submit'])) {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
        } 
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        } 
        if (isset($_POST['password'])) {
            $password = sha1($_POST['password']);
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

catch(\Exception $e) {
    $errorMessage = $e->getMessage();
    include 'view/errorView.php';
}

echo "user : " . $username . "    ";
echo "email : " . $email . "    ";
echo "password : " . $password . "    ";
echo "remember : " . $remember . "    ";