<?php

require_once '../model/frontend/PostManager.php';
require_once '../model/frontend/CommentManager.php';
require_once '../controler/backend/Session.php';

function admin()
{
    $session = Session::getInstance();
    
    if ($session->auth) {
        if (isset($_GET['addpost'])) {
            if ($_GET['addpost'] == 'success') {
                $message = "<div class=\"alert alert-success text-center\" role=\"success\">Le billet à bien été posté !</div>";
            } else {
                $message =  "<div class=\"alert alert-danger text-center\" role=\"alert\"><strong>Erreur ! </strong>Le billet n'a pas pu être posté</div>";
            }
        } elseif (isset($_GET['deletepost'])) {
            if ($_GET['deletepost'] == 'success') {
                $message = "<div class=\"alert alert-success text-center\" role=\"success\">Le billet à bien supprimé !</div>";
            } else {
                $message =  "<div class=\"alert alert-danger text-center\" role=\"alert\"><strong>Erreur ! </strong>Le billet n'a pas pu être supprimé</div>";
            }
        } elseif (isset($_GET['action']) && ($_GET['action'] == 'editpostform')) {
            if (isset($_GET['id'])) {
                $postManager = new PostManager();
    
                $editpost = $postManager->getPost($_GET['id']);
            }
        } elseif (isset($_GET['editpost'])) {
            if ($_GET['editpost'] == 'success') {
                $message = "<div class=\"alert alert-success text-center\" role=\"success\">Le billet à bien modifié !</div>";
            } else {
                $message =  "<div class=\"alert alert-danger text-center\" role=\"alert\"><strong>Erreur ! </strong>Le billet n'a pas pu être modifié</div>";
            }
        }
        $postManager = new PostManager();
        $posts = $postManager->getPosts();

        include '../views/backend/admin.php';
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}
function addPost(string $title, string $postContent)
{
    $postManager = new PostManager();

    $addedContent = $postManager->addPost($title, $postContent);

    if ($addedContent === false) {
        throw new Exception('Impossible d\'ajouter le billet');
    } else {
        header('Location: index.php?p=admin&addpost=success');
    }
}
function deletePost(int $id)
{
    $postManager = new PostManager();

    $deletedpost = $postManager->deletePost($id);

    if ($deletedpost === false) {
        throw new Exception('Impossible de supprimer le billet');
    } else {
        header('Location: index.php?p=admin&deletepost=success');
    }
}
function editPost(int $id, string $title, string $content)
{
    $postManager = new PostManager();

    $editedpost = $postManager->editPost($id, $title, $content);

    if ($editedpost === false) {
        throw new Exception('Impossible de modifier le billet');
    } else {
        header('Location: index.php?p=admin&editpost=success');
    }
}