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

        $message = Helper::setFlashMessage();

        $template = new Template(self::REGISTRATION_VIEW . '.php');
        $template->loadView([
            'categories' => $categories,
            'message' => $message,
            'nav' => Helper::setNav(),
        ]);
    }

    public function userRegistration(): void
    {
        if (empty($_POST['email']) || empty($_POST['last_name']) || empty($_POST['first_name']) || empty($_POST['pass1']) || empty($_POST['pass2'])) {
            Helper::redirectWithMessage(MESSAGES['missingData'], 'registration');
        }


        if ($_POST['pass1'] !== $_POST['pass2']) {
            Helper::redirectWithMessage(MESSAGES['pwMatch'], 'registration');
        }

        $user = new User();

        if (!isset($_POST['provider_check'])) {
            if ($user->addNewUser([
                'email' => $_POST['email'],
                'lastName' => $_POST['last_name'],
                'firstName' => $_POST['first_name'],
                'pw' => $_POST['pass1'],
            ])) {
                Helper::redirectWithMessage(MESSAGES['successReg'], 'home');
            }

            Helper::redirectWithMessage(MESSAGES['error'],'registration');
        }

        if (empty($_POST['service_category']) || empty($_POST['company_name']) || empty($_POST['company_district']) || empty($_POST['company_street']) || empty($_POST['company_description']) || empty($_POST['company_housenumber'])) {
            Helper::redirectWithMessage(MESSAGES['missingData'], 'registration');
        }


        if ($user->addNewServiceProvider([
            'email' => $_POST['email'],
            'lastName' => $_POST['last_name'],
            'firstName' => $_POST['first_name'],
            'pw' => $_POST['pass1'],
            'category' => $_POST['service_category'],
            'companyName' => $_POST['company_name'],
            'companyDistrict' => $_POST['company_district'],
            'companyAddress' => $_POST['company_street'],
            'companyHousenumber' => $_POST['company_housenumber'],
            'companyDescription' => $_POST['company_description'],
        ])) {
            Helper::redirectWithMessage(MESSAGES['successReg'], 'home');
        }

        Helper::redirectWithMessage(MESSAGES['error'],'registration');
    }
}
