<?php

namespace app\models;

use core\DatabaseHandler;

class User
{
    private DatabaseHandler $dbConn;

    public function __construct()
    {
        $this->dbConn = new DatabaseHandler();
    }

    public function addNewUser(array $userData): bool
    {
        $userRoleID = '1';
        $this->dbConn->query("INSERT INTO user (role_id, first_name, last_name, email_address, password)
                                    VALUES (:role_id, :first_name, :last_name, :email_address, :password)");


        $this->dbConn->bind(':role_id', $userRoleID);
        $this->dbConn->bind(':first_name', $userData['firstName']);
        $this->dbConn->bind(':last_name', $userData['lastName']);
        $this->dbConn->bind(':email_address', $userData['email']);
        $this->dbConn->bind(':password', $userData['pw']);

        return $this->dbConn->execute();
    }

    public function addNewServiceProvider(array $userData)
    {
//todo
    }
}