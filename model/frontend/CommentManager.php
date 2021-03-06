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
    public function selectComment(int $postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare(
            'SELECT id, author, comment, report, 
            DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') 
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
    public function insertComment(int $postId, string $author, string $comment)
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
     * Delete Comment
     * 
     * @param int    $postId  Post Id
     * 
     * @return bool $affectectedLines
     */
    public function deleteComment(int $commentId)
    {
        $db = $this->dbConnect();
        $deleteCommentReq = $db->prepare(
            'DELETE FROM comments
            WHERE id = :id'
        );

        $deleteComment = $deleteCommentReq->execute(array(':id'=>$commentId));

        return $deleteComment;
    }
    /**
     * Delete Comments Associated with deleted posts
     * 
     * @param int    $postId  Post Id
     * 
     * @return bool $affectectedLines
     */
    public function deleteCommentAsso(int $postId)
    {
        $db = $this->dbConnect();
        $deleteCommentAssoReq = $db->prepare(
            'DELETE FROM comments
            WHERE post_id = :postId'
        );

        $deleteComment = $deleteCommentAssoReq->execute(array(':postId'=>$postId));

        return $deleteComment;
    }
    /**
     * Report Comment
     * 
     * @param int $commentId Comment Id
     * 
     * @return bool $reportedcomment
     */
    public function updateReportComment(int $commentId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare(
            'UPDATE comments
            SET report = 1
            WHERE id = :commentId'
        );

        $reportedcomment = $comments->execute(array(':commentId'=>$commentId));

        return $reportedcomment;
    }
    /**
     * Set Allowed Comment
     * 
     * @param int $commentId Comment Id
     * 
     * @return bool $setAllowReq
     */
    public function updateAllowComment(int $commentId)
    {
        $db = $this->dbConnect();
        $setAllowReq = $db->prepare(
            "UPDATE comments
            SET report = 0
            WHERE id = '$commentId'"
        );

        $setAllow = $setAllowReq->execute(array($commentId));

        return $setAllow;
    }
    /**
     * Get Moderate Comment
     * 
     * @param int $postId Post_Id
     * 
     * @return $comments
     */
    public function selectModerateComment(int $postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare(
            'SELECT id, author, comment, report, 
            DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') 
            AS comment_date_fr
            FROM comments
            WHERE post_id = ? && report != TRUE
            ORDER BY comment_date 
            DESC'
        );

        $comments->execute(array($postId));

        return $comments;
    }
    /**
     * Get Moderate Comment Count
     * 
     * @param int $postId Post_Id
     * 
     * @return $commentCount
     */
    public function selectModerateCommentCount(int $postId)
    {
        $db = $this->dbConnect();
        $commentCountReq = $db->prepare(
            'SELECT id, author, comment, report 
            FROM comments
            WHERE post_id = ? && report != TRUE'
        );

        $commentCountReq->execute(array($postId));
        $commentsCountArray = $commentCountReq->fetchAll();
        $commentCount = count($commentsCountArray);

        return $commentCount;
    }
    /**
     * Get Reported Comment
     * 
     * @param int $postId Post_Id
     * 
     * @return $comments
     */
    public function selectReportedComments()
    {
        $db = $this->dbConnect();
        $getReportReq = $db->prepare(
            'SELECT id, post_id, author, comment, report, 
            DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') 
            AS comment_date_fr
            FROM comments
            WHERE report != FALSE
            ORDER BY comment_date 
            DESC'
        );

        $getReportReq->execute(array());

        return $getReportReq;
    }
    /**
     * Get Unreported Comment
     * 
     * @param int $postId Post_Id
     * 
     * @return $comments
     */
    public function selectUnreportedComments()
    {
        $db = $this->dbConnect();
        $getUnreportReq = $db->prepare(
            'SELECT id, post_id, author, comment, report, 
            DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') 
            AS comment_date_fr
            FROM comments
            WHERE report = FALSE
            ORDER BY comment_date 
            DESC'
        );

        $getUnreportReq->execute(array());

        return $getUnreportReq;
    }
}