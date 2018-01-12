<?php
/**
 * Routing
 * PHP version 7.1.9
 * 
 * @category Routing
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */
require 'controler/frontend/post.php';
require 'controler/frontend/comment.php';
require 'controler/backend/users.php';

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        } elseif ($_GET['action'] == 'post') { 
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            } else { 
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'logout') {
            include 'controler/backend/logout.php';
            logout();
        } else {
            throw new Exception('Impossible de se déconnecter');
        } 
    } elseif (isset($_GET['p'])) {
        if ($_GET['p'] == 'login') {
            if (isset($_POST['submit'])) {
                if (!empty($_POST['email']) && !empty($_POST['password'])) {
                    include 'controler/backend/login.php';
                    submitLogin($_POST['email'], $_POST['password']);
                } 
            } elseif (isset($_GET['err'])) {
                header("HTTP/1.0 404 Not Found");
            } else {
                (new User)->getAuth();
            }
        } else {
            listPosts();
        }
    } 
} 

catch(Exception $e) {
    $errorMessage = $e->getMessage();
    include '../views/errorView.php';
    include '../views/nav.php';
    include '../views/template.php';
}