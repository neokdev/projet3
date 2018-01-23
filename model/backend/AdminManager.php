<?php
require_once '../src/Projet3/Database/Database.php';

class AdminManager extends Database
{
    public function selectUser(string $email)
    {
        $db = $this->dbConnect();
        $selectUserReq = $db->query(
            "SELECT *
            FROM users
            WHERE email = '$email'"
        );
        $auth = $selectUserReq->fetchAll(\PDO::FETCH_OBJ);
        
        return $auth;
    }
    public function selectUserList()
    {
        $db = $this->dbConnect();
        $selectUserListReq = $db->prepare(
            'SELECT id, email, 
            DATE_FORMAT(creation_date, \'%d/%m/%Y\')
            AS creation_date
            FROM users
            ORDER BY creation_date
            '
        );
        $selectUserListReq->execute(array());
        
        return $selectUserListReq;
    }
    public function updateUser(int $id, string $email)
    {
        $db = $this->dbConnect();
        $updateUserReq = $db->prepare(
            'UPDATE users
            SET email = :email
            WHERE id = :id'
        );

        $updateUser = $updateUserReq->execute(array(':id'=>$id,'email'=>$email));

        return $updateUser;
    }
    public function updatePass(int $id, string $pass)
    {
        $db = $this->dbConnect();
        $updatePassReq = $db->prepare(
            'UPDATE users
            SET password = :pass
            WHERE id = :id'
        );

        $updatePass = $updatePassReq->execute(array(':id'=>$id,':pass'=>$pass));

        return $updatePass;
    }
    public function insertUser(string $email, string $pass)
    {
        $db = $this->dbConnect();
        $insertUserReq = $db->prepare(
            'INSERT INTO users(email, password, creation_date)
            VALUES(?, ?, NOW())'
        );

        $insertUser = $insertUserReq->execute(array($email, $pass));

        return $insertUser;
    }
    public function deleteUser(int $userId) 
    {
        $db = $this->dbConnect();
        $deleteUserReq = $db->prepare(
            'DELETE FROM users
            WHERE id = :userId'
        );

        $deletedUser = $deleteUserReq->execute(array(':userId'=>$userId));

        return $deletedUser;
    }
}