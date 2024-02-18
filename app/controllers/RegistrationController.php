<?php

namespace app\controllers;

use app\helpers\Helper;
use app\models\Service;
use app\models\User;
use core\Template;

class RegistrationController
{
    const REGISTRATION_VIEW = "registration_view";

    public function index(): void
    {
        $service = new Service();
        $categories = $service->loadCategories();

        $template = new Template(self::REGISTRATION_VIEW . '.php');
        $template->loadView([
            'categories' => $categories,
        ]);
    }

    public function userRegistration(): bool
    {
        if (!isset($_POST['email']) && !isset($_POST['last_name']) && !isset($_POST['first_name']) && !isset($_POST['pass1']) && !isset($_POST['pass2']) && $_POST['pass1'] !== $_POST['pass2']) {
            Helper::redirectWithMessage(MESSAGES['error'], 'registration');
        }

        $user = new User();

        if (!isset($_POST['provider_check'])) {
            return $user->addNewUser([
                'email' => $_POST['email'],
                'lastName' => $_POST['last_name'],
                'firstName' => $_POST['first_name'],
                'pw' => $_POST['pass1'],
            ]);
        }

        return $user->addNewServiceProvider([
            'email' => $_POST['email'],
            'lastName' => $_POST['last_name'],
            'firstName' => $_POST['first_name'],
            'pw' => $_POST['pass1'],
            'category' => $_POST['service_category'],
            'companyName' => $_POST['company_name'],
            'companyDistrict' => $_POST['company_district'],
            'companyAddress' => $_POST['company_address'],
            'companyDescription' => $_POST['company_description'],
        ]);

    }
}