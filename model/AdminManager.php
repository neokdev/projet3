<?php
namespace Neok\projet3\model;
require_once 'model/Manager.php';
class AdminManager extends Manager
{
    /**
     * Get Comment
     * 
     * @param string $username
     * @param string $email
     * @param string $password
     * @param bool $remember
     * 
     * @return bool
     */
    public function login($username, $email, $password, $remember) 
    {
        $db = $this->dbConnect();
        $user = $db->prepare(
            'SELECT * 
            FROM users
            WHERE username = ?, [$username], null, true'
        );
    }
    public function logged()
    {
        return isset($_SESSION['auth']);
    }
    public function getUserInfo($username)
    {
        $db = $this->dbConnect();
        $user = $db->prepare(
            'SELECT id, username, email, password,
            FROM users
            WHERE username = ?, [$username], null, true'
        );

        $user->execute(array($username));
        return $user;

    }

}