<?php
/**
 * Frontend Comment Controler file
 * PHP version 7.1.9
 * 
 * @category Controler
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */

require_once '../model/frontend/CommentManager.php';
/**
 * Add Comment
 * 
 * @param int    $postId  Post Id
 * @param string $author  Comment Author
 * @param string $comment Comment
 * 
 * @return $post
 */
function addComment(int $postId,string $author,string $comment, $captchaRes)
{
    $captchaSecret = "6LehEEIUAAAAAAqGTioOG9n25EWvGvP5IVFFvcMV";
    $captchaRemoteIp = $_SERVER['REMOTE_ADDR'];
    $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $captchaSecret . "&response=" . $captchaRes . "&remoteip=" . $captchaRemoteIp;

    $decode = json_decode(file_get_contents($api_url), true);

    if ($decode['success'] == true) {
        $commentManager = new CommentManager();
        $affectedLines = $commentManager->insertComment($postId, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        } else {
            $message = "<div class=\"alert alert-success text-center\" role=\"success\">Le commentaire a bien été ajouté !</div>";
            getPostComment($postId, $message);
        }
    } else {
        throw new Exception('Captcha non valide');
    }

    
}
function SetReportComment(int $postId,int $commentId)
{
    $commentManager = new CommentManager();

    $setReportReq = $commentManager->updateReportComment($commentId);

    if ($setReportReq === false) {
        throw new Exception('Impossible de signaler le commentaire !');
    } else {
        header("Location: index.php?action=post&id=$postId&report=success");
    }
}