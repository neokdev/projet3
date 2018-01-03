<?php
/**
 * Frontend Model file
 * 
 * PHP version 7.1
 * 
 * @category Model
 * @package  PackageName
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://www.projet3.nekbot.com/
 * 
 * @file
 * Model file
 */
/**
 * Posts query
 * 
 * @return $req
 */
function getPosts()
{
    $db = dbConnect();
    $req = $db->query(
        'SELECT id, title, content, 
        DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS creation_date_fr 
        FROM posts 
        ORDER BY creation_date 
        DESC LIMIT 0, 5'
    );

    return $req;
}
/**
 * Get post
 * 
 * @param int $postId Post Id
 * 
 * @return $post
 */
function getPost($postId)
{
    $db = dbConnect();
    $req = $db->prepare(
        'SELECT id, title, content, 
        DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS creation_date_fr 
        FROM posts 
        WHERE id = ?'
    );
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
}
/**
 * Get post
 * 
 * @param int $postId Post Id
 * 
 * @return $comments
 */
function getComments($postId)
{
    $db = dbConnect();
    $comments = $db->prepare(
        'SELECT id, author, comment, 
        DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS comment_date_fr 
        FROM comments 
        WHERE post_id = ? 
        ORDER BY comment_date 
        DESC'
    );
    $comments->execute(array($postId));

    return $comments;
}
/**
 * Database connection
 * 
 * @return PDO 
 */
function dbConnect()
{
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=test;charset=utf8',
            'root',
            'root'
        );
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}
/**
 * Post comment
 * 
 * @param int    $postId  Post Id
 * @param string $author  Comment Author
 * @param string $comment Comment
 * 
 * @return $post
 */
function postComment($postId, $author, $comment)
{
    $db = dbConnect();
    $comments = $db->prepare(
        'INSERT INTO comments(post_id, author, comment, comment_date) 
        VALUES(?, ?, ?, NOW())'
    );
    $affectedLines = $comments->execute(array($postId, $author, $comment));

    return $affectedLines;
}