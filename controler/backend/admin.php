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
        $reportedComments = $commentManager->selectReportedComments();
        $comments = $commentManager->selectUnreportedComments();
        $userList = $adminmanager->selectUserList();

        include '../views/backend/admin.php';
    } else {
        header('HTTP/1.1 403 Forbidden');
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
        $reportedComments = $commentManager->selectReportedComments();
        $comments = $commentManager->selectUnreportedComments();
        $userList = $adminmanager->selectUserList();

        include '../views/backend/admin.php';
    } else {
        header('HTTP/1.1 403 Forbidden');
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
                    $message = "<div class=\"alert alert-info alert-dismissible fade show text-center\" role=\"alert\">L'adresse email à bien été changée<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button></div>";
                    showAdmin($message);
                }
            } else {
                throw new Exception('Mot de passe invalide');
            }
        } else {
            throw new Exception("Les adresse emails sont différentes");
        }
    } else {
        header('HTTP/1.1 403 Forbidden');
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
                $message = "<div class=\"alert alert-info alert-dismissible fade show text-center\" role=\"alert\">Le mot de passe a bien été changé<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button></div>";
                showAdmin($message);
            }
        } else {
            throw new Exception("Les mots de passe sont différents");
        }
    } else {
        header('HTTP/1.1 403 Forbidden');
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
                $message = "<div class=\"alert alert-success alert-dismissible fade show text-center\" role=\"alert\">L'administrateur à bien été ajouté<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button></div>";
                showAdmin($message);
            }
        } else {
            throw new Exception("Les mots de passe sont différents");
        }
    } else {
        header('HTTP/1.1 403 Forbidden');
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
            $message = "<div class=\"alert alert-info alert-dismissible fade show text-center\" role=\"alert\">L'administrateur a bien été supprimé'<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button></div>";
            showAdmin($message);
        }
    }  else {
        header('HTTP/1.1 403 Forbidden');
    }
}