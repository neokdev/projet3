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
function reportComment($commentId)
{
    $commentManager = new CommentManager();

    $reportedcomment = $commentManager->setReported($commentId);

    if ($reportedcomment === false) {
        throw new Exception('Impossible de signaler le commentaire !');
    } else {
        header('Location: index.php?report=success');
    }
}