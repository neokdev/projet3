<?php
/**
 * Comment Manager
 * PHP version 7.1.9
 * 
 * @category Model
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */
namespace Neok\projet3\model;

require_once 'model/Manager.php';
/**
 * CommentManager_Class
 * 
 * @category Class
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */
class CommentManager extends Manager
{
    /**
     * Get Comment
     * 
     * @param int $postId Post_Id
     * 
     * @return $comments
     */
    public function getComments($postId)
    {
        $db = $this->dbConnect();
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
     * Post Comment
     * 
     * @param int    $postId  Post Id
     * @param string $author  Comment Author
     * @param string $comment Comment
     * 
     * @return $post
     */
    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare(
            'INSERT INTO comments(post_id, author, comment, comment_date)
            VALUES(?, ?, ?, NOW())'
        );

        $affectectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectectedLines;
    }
}