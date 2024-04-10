<?php

namespace app\controllers;

use app\helpers\Helper;
use app\models\Service;
use app\models\User;
use core\Template;
use JetBrains\PhpStorm\NoReturn;

class ProviderProfileController
{
    const PROFILE_PROVIDER_VIEW = "profile_provider_view";
    const PROVIDER_UPDATE_VIEW = "provider_update_view";

    public function index(): void
    {
        $service = new Service();

        $template = new Template(self::PROFILE_PROVIDER_VIEW . '.php');
        $template->loadView([
            'message' => Helper::setFlashMessage(),
            'nav' => Helper::setNav(),
            'freeAppointments' => $service->getFreeAppointmentsOfProvider(),
            'upcomingAppointments' => $service->getUpcomingReservationsOfProvider(),
            'pastAppointments' => $service->getPastReservationsOfProvider(),
        ]);
    }

    #[NoReturn] public function logout()
    {
        if (User::logout()) {
            Helper::redirectWithMessage(MESSAGES['logout'], 'home');
        }

        Helper::redirectWithMessage('', 'home');
    }

    public function updateProfile()
    {
        $service = new Service();
        $categories = $service->loadCategories();
        $serviceData = $service->getServiceData();

        $template = new Template(self::PROVIDER_UPDATE_VIEW . '.php');
        $template->loadView([
            'message' => Helper::setFlashMessage(),
            'nav' => Helper::setNav(),
            'categories' => $categories,
            'serviceData' => $serviceData,
        ]);
    }

    #[NoReturn] public function updatePassword()
    {
        if (empty($_POST['oldPassword']) || empty($_POST['newPassword'])) {
            Helper::redirectWithMessage(MESSAGES['pwUpdateError'], 'service_profile/updateProfile');
        }

        $user = new User();

        if ($user->updatePassword($_POST['oldPassword'], $_POST['newPassword'], 'service_profile')) {
            Helper::redirectWithMessage(MESSAGES['pwUpdateSuccess'], 'service_profile');
        }

        Helper::redirectWithMessage(MESSAGES['error'], 'service_profile/updateProfile');
    }

    #[NoReturn] public function updateService(): void
    {
        if (empty($_POST['service_category']) || empty($_POST['company_name']) || empty($_POST['company_district']) || empty($_POST['company_street']) || empty($_POST['company_description']) || empty($_POST['company_housenumber'])) {
            Helper::redirectWithMessage(MESSAGES['missingData'], 'service_profile/updateProfile');
        }

        $user = new User();

        if ($user->updateServiceData([
            'category' => $_POST['service_category'],
            'companyName' => $_POST['company_name'],
            'companyDistrict' => $_POST['company_district'],
            'companyAddress' => $_POST['company_street'],
            'companyHousenumber' => $_POST['company_housenumber'],
            'companyDescription' => $_POST['company_description'],
        ])) {
            Helper::redirectWithMessage(MESSAGES['serviceUpdateSuccess'], 'service_profile');
        }

        Helper::redirectWithMessage(MESSAGES['error'], 'service_profile/updateProfile');
    }

    public function deleteAppointment()
    {
        if (empty($_POST['appointmentId'])) {
            http_response_code(400);
            exit();
        }

        $service = new Service();

        if ($service->deleteAppointment($_POST['appointmentId'])) {
            $appointments = $service->getFreeAppointmentsOfProvider();
            exit(json_encode($appointments));
        }

        http_response_code(400);
        exit();
    }

    #[NoReturn] public function deleteProfile(): void
    {
        if (!empty($_SESSION['user'])) {
           $user = new User();
           $user->deleteProfile($_SESSION['user'], 'service_profile');
        }

        Helper::redirectWithMessage('', 'home');
    }
}
