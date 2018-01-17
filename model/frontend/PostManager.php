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

require_once '../src/Projet3/Database/Database.php';
/**
 * PostManager_Class
 * 
 * @category Class
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */
class PostManager extends Database
{
    /**
     * Posts query
     * 
     * @return $req
     */
    public function selectPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query(
            'SELECT id, title, content, 
            DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') 
            AS creation_date_fr
            FROM posts
            ORDER BY creation_date 
            DESC'
        );

        return $req;
    }
    /**
     * Get post
     * 
     * @param int $postId Post_Id
     * 
     * @return bool $post
     */
    public function selectPostComment($postId)
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
    /**
     * Add post
     * 
     * @param string $title Titre du post
     * @param string $postContent Contenu du post
     * 
     * @return bool $addedpost
     */
    public function insertPost(string $title, string $postContent)
    {
        $db = $this->dbConnect();
        $post = $db->prepare(
            'INSERT INTO posts(title, content, creation_date)
            VALUES(?, ?, NOW())'
        );
        $addedpost = $post->execute(array($title, $postContent));

        return $addedpost;
    }
    /**
     * Delete post
     * 
     * @param int $id Id du post
     * 
     * @return bool $deletedpost
     */
    public function deletePost(int $id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(
            "DELETE FROM posts
            WHERE id = '$id'"
        );
        $deletedpost = $req->execute(array($id));

        return $deletedpost;
    }
    /**
     * Edit post
     * 
     * @param int $id Id du post
     * @param string $title Titre du post
     * @param string $content Contenu du post
     * 
     * @return bool $post
     */
    public function updatePost(int $id, string $title, string $postContent)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(
            'UPDATE posts
            SET title = "$title", content = "$postContent"
            WHERE id = "$id"'
        );
        $updatedpost = $req->execute(array($id, $title, $postContent));

        return $updatedpost;
    }
}