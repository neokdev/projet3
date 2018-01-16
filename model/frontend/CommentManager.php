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

require_once '../src/Projet3/Database/Database.php';
/**
 * CommentManager_Class
 * 
 * @category Class
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */
class CommentManager extends Database
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
     * @return bool $affectectedLines
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
    /**
     * Report Comment
     * 
     * @param int $commentId Comment Id
     * 
     * @return bool $reportedcomment
     */
    public function setReported($commentId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare(
            "UPDATE comments
            SET report = 1
            WHERE id = '$commentId'"
        );

        $reportedcomment = $comments->execute(array($commentId));

        return $reportedcomment;
    }
}