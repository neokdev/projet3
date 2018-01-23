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
require 'controler/backend/admin.php';
require 'controler/backend/adminpost.php';
require 'controler/backend/admincomment.php';
require 'controler/backend/login.php';

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'getPosts') {
            getPosts();
        } elseif ($_GET['action'] == 'post') { 
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                getPostComment($_GET['id']);
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
        } elseif ($_GET['action'] == 'addpost') {
            if (!empty($_POST['title']) && !empty($_POST['postContent'])) {
                addPost($_POST['title'], $_POST['postContent']);
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        } elseif ($_GET['action'] == 'setpost') {
            if (isset($_GET['id']) && isset($_POST['title']) && isset($_POST['postContent'])) {
                setPost($_GET['id'], $_POST['title'], $_POST['postContent']);
            } elseif (isset($_GET['id'])) {
                showAdminSetPost($_GET['id']);
            } else {
                throw new Exception('L\'id de billet est invalide.');
            }
        } elseif ($_GET['action'] == 'logout') {
            include 'controler/backend/logout.php';
            logout();
        } elseif ($_GET['action'] == 'deletepost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                delPost($_GET['id']);
            } else {
                throw new Exception('Erreur de suppréssion de billet.');
            }
        } elseif ($_GET['action'] == 'reportcomment') {
            SetReportComment($_GET['post_id'], $_GET['id']);
        } elseif ($_GET['action'] == 'allowcomment') {
            setAllowComment($_GET['id']);
        } elseif ($_GET['action'] == 'deleteuser') {
            delUser($_GET['id']);
        } elseif ($_GET['action'] == 'deletecomment') {
            delComment($_GET['id']);
        } else {
            throw new Exception('Action incorrecte');
        }
    } elseif (isset($_GET['p'])) {
        if ($_GET['p'] == 'login') {
            if (isset($_POST['submitlogin'])) {
                if (!empty($_POST['email']) && !empty($_POST['password'])) {
                    login($_POST['email'], $_POST['password']);
                } else {
                    throw new Exception('Veuillez remplir tous les champs');
                }
            } else {
                showLogin();
            } 
        } elseif ($_GET['p'] == 'admin') {
            if (isset($_POST['mail'])) {
                setUser($_POST['mailmail'], $_POST['mailconfirm'], $_POST['mailpass']);
            } elseif (isset($_POST['pass'])) {
                setUserPass($_POST['passpass'], $_POST['passconfirm']);
            } elseif (isset($_POST['user'])) {
                addUser($_POST['adminmail'], $_POST['adminpass'], $_POST['adminconfirm']);
            } else {
                showAdmin();
            }
        } else {
            getPosts();
        }
    } else {
        getPosts();
    }
}

catch(Exception $e) {
    $errorMessage = $e->getMessage();
    include '../views/errorView.php';
    include '../views/nav.php';
    include '../views/template.php';
}