<?php
/**
 * @file
 * Controler file
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
        die('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}