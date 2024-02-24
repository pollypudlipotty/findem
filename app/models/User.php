<?php

namespace app\models;

use app\helpers\Helper;
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
        if (!$this->validateEmail($userData['email'])) {
            Helper::redirectWithMessage($_SESSION['message'], 'registration');
        }

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

    public function addNewServiceProvider(array $userData): bool
    {
        if (!$this->validateEmail($userData['email'])) {
            Helper::redirectWithMessage($_SESSION['message'], 'registration');
        }

        $userRoleID = '2';
        $this->dbConn->query("INSERT INTO user (role_id, first_name, last_name, email_address, password)
                                    VALUES (:role_id, :first_name, :last_name, :email_address, :password)");

        $this->dbConn->bind(':role_id', $userRoleID);
        $this->dbConn->bind(':first_name', $userData['firstName']);
        $this->dbConn->bind(':last_name', $userData['lastName']);
        $this->dbConn->bind(':email_address', $userData['email']);
        $this->dbConn->bind(':password', $userData['pw']);

        if ($this->dbConn->execute()) {
            $lastInsertedId = $this->dbConn->lastInsertId();

            $this->dbConn->query("INSERT INTO service (service_provider_id, service_category_id, service_name, service_district, service_address, service_description)
                                    VALUES (:service_provider_id, :service_category_id, :service_name, :service_district, :service_address, :service_description)");

            $this->dbConn->bind(':service_provider_id', $lastInsertedId);
            $this->dbConn->bind(':service_category_id', $userData['category']);
            $this->dbConn->bind(':service_name', $userData['companyName']);
            $this->dbConn->bind(':service_district', $userData['companyDistrict']);
            $this->dbConn->bind(':service_address', $userData['companyAddress']);
            $this->dbConn->bind(':service_description', $userData['companyDescription']);

            return $this->dbConn->execute();
        }

        return false;
    }

    public function validateEmail(string $emailInput): bool
    {
        if (!filter_var($emailInput, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = MESSAGES['invalidEmail'];
            return false;
        }

        $this->dbConn->query("SELECT * FROM user WHERE email_address = :email");
        $this->dbConn->bind(':email', $emailInput);
        $result = $this->dbConn->resultSet();

        if ($result) {
            $_SESSION['message'] = MESSAGES['duplicateEmail'];
            return false;
        }
        return true;
    }
}
