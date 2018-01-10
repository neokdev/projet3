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


use Neok\Projet3\Model\PostManager;
use Neok\Projet3\Model\CommentManager;

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