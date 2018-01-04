<?php
/**
 * Manager
 * PHP version 7.1.9
 * 
 * @category Model
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://www.projet3.nekbot.com/
 */
class Manager
{
    /**
     * Database connection
     * 
     * @return PDO 
     */
    protected function dbConnect()
    {
        $db = new PDO(
            'mysql:host=localhost;
            dbname=test;
            charset=utf8',
            'root',
            'root'
        );

        return $db;
    }
}