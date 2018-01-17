<?php
function addPost(string $title, string $postContent)
{
    $session = Session::getInstance();
    
    if ($session->auth) {
        
        $postManager = new PostManager();
        $addContent = $postManager->insertPost($title, $postContent);

        if ($addContent === false) {
            throw new Exception('Impossible d\'ajouter le billet');
        } else {
            $message = "<div class=\"alert alert-success text-center\" role=\"success\">Le billet à bien été posté !</div>";
            showAdmin($message);
        }
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}
function setPost(int $id, string $title, string $content)
{
    $session = Session::getInstance();
    
    if ($session->auth) {
        $postManager = new PostManager();
        $updatedpost = $postManager->updatePost($id, $title, $content);

        if ($updatedpost === false) {
            throw new Exception('Impossible de modifier le billet');
        } else {
            $message = "<div class=\"alert alert-success text-center\" role=\"success\">Le billet à bien modifié !</div>";
            showAdmin($message);
        }
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}
function delPost(int $id)
{
    $session = Session::getInstance();
    
    if ($session->auth) {
        $postManager = new PostManager();
        $deletedpost = $postManager->deletePost($id);

        if ($deletedpost === false) {
            throw new Exception('Impossible de supprimer le billet');
        } else {
            $message = "<div class=\"alert alert-success text-center\" role=\"success\">Le billet à bien supprimé !</div>";
            showAdmin($message);
        }
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}