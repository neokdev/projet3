<?php
/**
 * Frontend Comment Controler file
 * PHP version 7.1.9
 * 
 * @category Controler
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */

require_once '../model/frontend/CommentManager.php';
/**
 * Add Comment
 * 
 * @param int    $postId  Post Id
 * @param string $author  Comment Author
 * @param string $comment Comment
 * 
 * @return $post
 */
function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
function reportComment($postId, $commentId)
{
    $commentManager = new CommentManager();

    $setReportReq = $commentManager->setReported($commentId);

    if ($setReportReq === false) {
        throw new Exception('Impossible de signaler le commentaire !');
    } else {
        header("Location: index.php?action=post&id=$postId&report=success");
    }
}
function getReportedComment()
{
    $commentManager = new CommentManager();

    $reportedComments = $commentManager->getReportedComments();

    include '../views/backend/admin.php';
}
function AllowComment($commentId)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $posts = $postManager->getPosts();
    $reportedComments = $commentManager->getReportedComments();
    $setAllowedComment = $commentManager->setAllowedComment($commentId);

    include '../views/backend/admin.php';
}