<?php

require_once '../model/frontend/PostManager.php';
require_once '../model/frontend/CommentManager.php';
require_once '../controler/backend/Session.php';

function showAdmin(string $message = null): void
{
    $session = Session::getInstance();
    
    if ($session->auth) {
        
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        $adminmanager = new AdminManager();

        $posts = $postManager->selectPosts();
        $reportedComments = $commentManager->selectReportedComment();
        $userList = $adminmanager->selectUserList();
        include '../views/backend/admin.php';
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}
function showAdminSetPost(int $id): void
{
    $session = Session::getInstance();
    
    if ($session->auth) {
        
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        $adminmanager = new AdminManager();

        $setPost = $postManager->selectPostComment($id);

        $posts = $postManager->selectPosts();
        $reportedComments = $commentManager->selectReportedComment();
        $userList = $adminmanager->selectUserList();

        include '../views/backend/admin.php';
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}
function setUser(string $newMail, string $newMailconfirm, string $pass)
{
    $session = Session::getInstance();
    $adminmanager = new AdminManager();
    $user = $adminmanager->selectUser($session->email);
    
    if ($session->auth) {
        $userId = $session->id;
        if ($newMail === $newMailconfirm) {
            if (password_verify($pass, $user[0]->password)) {
                $updatedUser = $adminmanager->updateUser($userId, $newMail);
                if ($updatedUser === false) {
                    throw new Exception('Impossible de changer le mail !');
                } else {
                    $message = "<div class=\"alert alert-success text-center\" role=\"success\">Le mail a bien été changé !</div>";
                    showAdmin($message);
                }
            } else {
                throw new Exception('Mot de passe invalide');
            }
        } else {
            throw new Exception("Les adresse emails sont différentes");
        }
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}
function setUserPass(string $newPass, string $newPassConfirm)
{
    $session = Session::getInstance();
    $adminmanager = new AdminManager();
    
    if ($session->auth) {
        $userId = $session->id;
        if ($newPass === $newPassConfirm) {
            $updatedPass = $adminmanager->updatePass($userId, password_hash($newPass, PASSWORD_DEFAULT));
            if ($updatedPass === false) {
                throw new Exception('Impossible de changer le mot de passe !');
            } else {
                $message = "<div class=\"alert alert-success text-center\" role=\"success\">Le mot de passe a bien été changé !</div>";
                showAdmin($message);
            }
        } else {
            throw new Exception("Les mots de passe sont différents");
        }
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}
function addUser(string $email, string $pass, string $passConfirm)
{
    $session = Session::getInstance();
    $adminmanager = new AdminManager();
    
    if ($session->auth) {
        if ($pass === $passConfirm) {
            $addedPass = $adminmanager->insertUser($email, password_hash($pass, PASSWORD_DEFAULT));
            if ($addedPass === false) {
                throw new Exception('Impossible d\'ajouter un nouvel administrateur !');
            } else {
                $message = "<div class=\"alert alert-success text-center\" role=\"success\">L'administrateur a bien été ajouté !</div>";
                showAdmin($message);
            }
        } else {
            throw new Exception("Les mots de passe sont différents");
        }
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}
function delUser(int $id)
{
    $session = Session::getInstance();
    $adminmanager = new AdminManager();
    
    if ($session->auth) {
        $deletedUser = $adminmanager->deleteUser($id);

        if ($deletedUser === false) {
            throw new Exception('Impossible de supprimmer cet administrateur !');
        } else {
            $message = "<div class=\"alert alert-success text-center\" role=\"success\">L'administrateur a bien été supprimé !</div>";
            showAdmin($message);
        }
    }  else {
        header('HTTP/1.0 403 Forbidden');
    }
}