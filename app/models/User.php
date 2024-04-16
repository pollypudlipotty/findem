<?php

namespace app\models;

use app\helpers\Helper;
use core\DatabaseHandler;
use JetBrains\PhpStorm\NoReturn;

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

        $userRoleID = 1;
        $this->dbConn->query("INSERT INTO user (role_id, first_name, last_name, email_address, password)
                                    VALUES (:role_id, :first_name, :last_name, :email_address, :password)");


        $this->dbConn->bind(':role_id', $userRoleID);
        $this->dbConn->bind(':first_name', $userData['firstName']);
        $this->dbConn->bind(':last_name', $userData['lastName']);
        $this->dbConn->bind(':email_address', $userData['email']);
        $this->dbConn->bind(':password', $userData['pw']);

        if ($this->dbConn->execute()) {
            $_SESSION['user'] = $this->dbConn->lastInsertId();
            $_SESSION['user_role'] = $userRoleID;
            return true;
        }

        return false;
    }

    public function addNewServiceProvider(array $userData): bool
    {
        if (!$this->validateEmail($userData['email'])) {
            Helper::redirectWithMessage($_SESSION['message'], 'registration');
        }

        $userRoleID = 2;
        $this->dbConn->query("INSERT INTO user (role_id, first_name, last_name, email_address, password)
                                    VALUES (:role_id, :first_name, :last_name, :email_address, :password)");

        $this->dbConn->bind(':role_id', $userRoleID);
        $this->dbConn->bind(':first_name', $userData['firstName']);
        $this->dbConn->bind(':last_name', $userData['lastName']);
        $this->dbConn->bind(':email_address', $userData['email']);
        $this->dbConn->bind(':password', $userData['pw']);

        if ($this->dbConn->execute()) {
            $lastInsertedId = $this->dbConn->lastInsertId();

            $this->dbConn->query("INSERT INTO service (service_provider_id, service_category_id, service_name, service_district, service_address, service_housenumber, service_description)
                                    VALUES (:service_provider_id, :service_category_id, :service_name, :service_district, :service_address, :service_housenumber, :service_description)");

            $this->dbConn->bind(':service_provider_id', $lastInsertedId);
            $this->dbConn->bind(':service_category_id', $userData['category']);
            $this->dbConn->bind(':service_name', $userData['companyName']);
            $this->dbConn->bind(':service_district', $userData['companyDistrict']);
            $this->dbConn->bind(':service_address', $userData['companyAddress']);
            $this->dbConn->bind(':service_housenumber', $userData['companyHousenumber']);
            $this->dbConn->bind(':service_description', $userData['companyDescription']);

            if ($this->dbConn->execute()) {
                $_SESSION['user'] = $lastInsertedId;
                $_SESSION['user_role'] = $userRoleID;
                return true;
            }

            return false;
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

    #[NoReturn] public function login(string $email, string $pass): void
    {
        $this->dbConn->query("SELECT * FROM user WHERE email_address = :email");
        $this->dbConn->bind(':email', $email);
        $result = $this->dbConn->single();

        if (!$result || $result['password'] !== $pass) {
            Helper::redirectWithMessage(MESSAGES['loginError'], 'login');
        }

        $_SESSION['user'] = $result['user_id'];
        $_SESSION['user_role'] = $result['role_id'];

        if ($_SESSION['user_role'] === 1) {
            Helper::redirectWithMessage(MESSAGES['welcome'] . ' ' . $result['first_name'] . '!', 'seeker_profile');
        }

        Helper::redirectWithMessage(MESSAGES['welcome'] . ' ' . $result['first_name'] . '!', 'service_profile');
    }

    public static function logout(): bool
    {
        if (isset($_SESSION['user'])) {
            session_unset();
            return true;
        }

        return false;
    }

    public function updatePassword(string $oldPassword, string $newPassword, string $route): bool
    {
        $this->dbConn->query("SELECT password FROM user WHERE user_id = :user_id");
        $this->dbConn->bind(':user_id', $_SESSION['user']);
        $result = $this->dbConn->single();

        if ($oldPassword != $result['password']) {
            Helper::redirectWithMessage(MESSAGES['wrongOldPw'], $route . '/updateProfile');
        }

        if ($oldPassword === $newPassword) {
            Helper::redirectWithMessage(MESSAGES['samePwError'], $route . '/updateProfile');
        }

        $this->dbConn->query("UPDATE user SET  password = :password
                                    WHERE user_id = :user_id");

        $this->dbConn->bind(':password', $newPassword);
        $this->dbConn->bind(':user_id', $_SESSION['user']);

        if ($this->dbConn->execute()) {
            return true;
        }

        return false;
    }

    public function updateServiceData(array $serviceData): bool
    {
        $this->dbConn->query("UPDATE service SET
                    service_category_id = :service_category_id,
                    service_name = :service_name,
                    service_district = :service_district,
                    service_address = :service_address,
                    service_housenumber = :service_housenumber,
                    service_description = :service_description
                    WHERE service_provider_id = :user_id");

        $this->dbConn->bind(':service_category_id', $serviceData['category']);
        $this->dbConn->bind(':service_name', $serviceData['companyName']);
        $this->dbConn->bind(':service_district', $serviceData['companyDistrict']);
        $this->dbConn->bind(':service_address', $serviceData['companyAddress']);
        $this->dbConn->bind(':service_housenumber', $serviceData['companyHousenumber']);
        $this->dbConn->bind(':service_description', $serviceData['companyDescription']);
        $this->dbConn->bind(':user_id', $_SESSION['user']);


        if ($this->dbConn->execute()) {
            return true;
        }

        return false;
    }

    #[NoReturn] public function deleteProfile(string $userId, string $current_url): void
    {
        $this->dbConn->query("DELETE FROM user WHERE user_id = :user_id");

        $this->dbConn->bind(':user_id', $userId);

        if ($this->dbConn->execute()) {
            session_unset();
            Helper::redirectWithMessage(MESSAGES['deleteProfileSuccess'], "home");
        }

        Helper::redirectWithMessage(MESSAGES['deleteProfileError'], $current_url);
    }

    public function getUserData(): bool|array
    {
        $this->dbConn->query("SELECT email_address, first_name, last_name
                                    FROM user where user_id = :user_id");

        $this->dbConn->bind(':user_id', $_SESSION['user']);
        return $this->dbConn->single();
    }
}
