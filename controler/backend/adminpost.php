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
            $message = "<div class=\"alert alert-success alert-dismissible fade show text-center\" role=\"alert\">Le billet à bien été ajouté<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button></div>";
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
            $message = "<div class=\"alert alert-info alert-dismissible fade show text-center\" role=\"alert\">Le billet à bien été modifié<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button></div>";
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
            $message = "<div class=\"alert alert-warning alert-dismissible fade show text-center\" role=\"alert\">Le billet à bien été supprimé<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button></div>";
            showAdmin($message);
        }
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}