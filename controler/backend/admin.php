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

        $posts = $postManager->selectPosts();
        $reportedComments = $commentManager->selectReportedComment();

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

        $setPost = $postManager->selectPostComment($id);

        $posts = $postManager->selectPosts();
        $reportedComments = $commentManager->selectReportedComment();

        include '../views/backend/admin.php';
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}