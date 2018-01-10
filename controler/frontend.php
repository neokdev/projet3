<?php
/**
 * Frontend Controler file
 * PHP version 7.1.9
 * 
 * @category Controler
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */
use Neok\projet3\model\PostManager;
use Neok\projet3\model\CommentManager;

require_once '../model/frontend/PostManager.php';
require_once '../model/frontend/CommentManager.php';
/**
 * Post comment
 * 
 * @return $post
 */
function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    include '../views/frontend/listPostsView.php';
}
/**
 * Get post list
 * 
 * @return view
 */
function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    include '../views/frontend/postView.php';
}
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