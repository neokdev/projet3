<?php

require_once '../model/frontend/PostManager.php';
require_once '../model/frontend/CommentManager.php';
require_once '../controler/backend/Session.php';

function admin()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    include '../views/backend/admin.php';
}