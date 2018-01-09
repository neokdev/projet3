<?php
/**
 * Post Manager
 * PHP version 7.1.9
 * 
 * @category Model
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */
namespace Neok\Projet3\Model;

require_once '../model/Manager.php';
/**
 * PostManager_Class
 * 
 * @category Class
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */
class PostManager extends Manager
{
    /**
     * Posts query
     * 
     * @return $req
     */
    public function getPosts()
    {
        $db = $this->dbConnect();
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
     * @param int $postId Post_Id
     * 
     * @return $post
     */
    public function getPost($postId)
    {
        $db = $this->dbConnect();
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
}