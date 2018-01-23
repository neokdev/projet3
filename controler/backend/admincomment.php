<?php
function getReportedComment()
{
    $session = Session::getInstance();
    
    if ($session->auth) {
        
        $commentManager = new CommentManager();

        $reportedComments = $commentManager->getReportedComments();

        if ($deletedComment === false) {
            throw new Exception('Impossible d\'afficher les commentaires');
        } else {
            showAdmin($message);
        }
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}
function delComment(int $postId)
{
    $session = Session::getInstance();
    
    if ($session->auth) {

        $commentManager = new CommentManager();

        $deletedComment = $commentManager->deleteComment($postId);

        if ($deletedComment === false) {
            throw new Exception('Impossible d\'éffacer le commentaire');
        } else {
            $message = "<div class=\"alert alert-warning alert-dismissible fade show text-center\" role=\"alert\">Le commentaire à bien été supprimé<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button></div>";
            showAdmin($message);
        }
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}
function setAllowComment($commentId)
{
    $session = Session::getInstance();
    
    if ($session->auth) {
        $commentManager = new CommentManager();
        $allowedComment = $commentManager->updateAllowComment($commentId);

        if ($allowedComment === false) {
            throw new Exception('Impossible d\autoriser le commentaire !');
        } else {
            $message = "<div class=\"alert alert-info alert-dismissible fade show text-center\" role=\"alert\">Le commentaire à bien été autorisé<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button></div>";
            showAdmin($message);
        }
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}