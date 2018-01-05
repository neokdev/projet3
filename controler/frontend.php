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
require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';
/**
 * Post comment
 * 
 * @return $post
 */
function listPosts()
{
    $postManager = new \Neok\projet3\model\PostManager();
    $posts = $postManager->getPosts();

    include 'view/frontend/listPostsView.php';
}
/**
 * Get post list
 * 
 * @return view
 */
function post()
{
    $postManager = new \Neok\projet3\model\PostManager();
    $commentManager = new \Neok\projet3\model\CommentManager();
    
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    include 'view/frontend/postView.php';
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
    $commentManager = new \Neok\projet3\model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}