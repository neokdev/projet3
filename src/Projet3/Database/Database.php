<?php
/**
 * Manager
 * PHP version 7.1.9
 * 
 * @category Model
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */
/**
 * Manager_Class
 * 
 * @category Class
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */
class Database
{
    /**
     * Database connection
     * 
     * @return PDO 
     */
    protected function dbConnect()
    {
        $db = new \PDO(
            'mysql:host=localhost;
            dbname=projet3;
            charset=utf8',
            'root',
            'root'
        );

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    }
    
}