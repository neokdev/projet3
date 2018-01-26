<?php
namespace Neok\Projet3\controller;

use PHPUnit\Framework\TestCase;
use Neok\Projet3\Model\AdminManager;

class StackTest extends TestCase
{}
    private $username;
    private $email;
    private $password;
    private $remember;

    public function getUsername()
    {
        return $this->username;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->getPassword;
    }
    public function getRemember()
    {
        return $this->remember;
    }
    public function getUserInfo()
    {
        $username = $this->getUsername($_POST['username']);
        $email = getEmail($_POST['email']);
        $password = getPassword($_POST['password']);
        $remember = getRemember($_POST['remember']);

        include '../views/backend/login.php';
        include '../views/nav.php';
        include '../views/template.php';

    }
}