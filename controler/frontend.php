<?php
/**
 * Frontend Controler file
 * 
 * PHP version 7.1.9
 * 
 * @category Controler
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://www.projet3.nekbot.com/
 */
require 'model/frontend.php';
/**
 * Post comment
 * 
 * @return $post
 */
function listPosts()
{
    $posts = getPosts();

    include 'view/frontend/listPostsView.php';
}
/**
 * Get post list
 * 
 * @return view
 */
function post()
{
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

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
    $affectedLines = postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}