<?php
/**
 * Frontend Post Controler file
 * PHP version 7.1.9
 * 
 * @category Controler
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */


require_once '../model/frontend/PostManager.php';
require_once '../model/frontend/CommentManager.php';
/**
 * 
 * 
 * @return $post
 */
function getPosts(string $message = null): void
{
    $postManager = new PostManager();

    $posts = $postManager->selectPosts();

    include '../views/frontend/listPostsView.php';
}
/**
 * Get post list
 * 
 * @return
 */
function getPostComment(int $postId, string $message = null): void
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    
    $post = $postManager->selectPostComment($postId);
    $comments = $commentManager->selectModerateComment($postId);

    include '../views/frontend/postView.php';
}
function getCommentEnum(int $postId): ?int
{
    $commentManager = new CommentManager();

    $commentEnum = $commentManager->selectModerateCommentCount($postId);

    if (isset($commentEnum)) {
        return $commentEnum;
    } else {
        return 0;
    }
    
}