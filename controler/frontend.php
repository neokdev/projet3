<?php
/**
 * @file
 * Controler file
 */
require 'model/frontend.php';

function listPosts()
{
    $posts = getPosts();

    include 'view/frontend/listPostsView.php';
}

function post()
{
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    include 'view/frontend/postView.php';
}

function addComment($postId, $author, $comment)
{
    $affectedLines = postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        die('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}