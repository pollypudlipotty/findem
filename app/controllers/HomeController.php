<?php

namespace app\controllers;

use app\helpers\Helper;
use app\models\Service;
use core\Template;
use JetBrains\PhpStorm\NoReturn;

class HomeController
{
    const HOME_VIEW = "home_view";

    public function index(): void
    {
        $service = new Service();

        $services = $service->loadCategories();
        $appointments = $service->loadAvailableAppointments();

        $message = Helper::setFlashMessage();

        $template = new Template(self::HOME_VIEW . '.php');
        $template->loadView([
            'services' => $services,
            'appointments' => $appointments,
            'message' => $message,
            'nav' => Helper::setNav(),
        ]);
    }

    public function sortCategories()
    {
        if (!isset($_POST['categoryId']) || empty($_POST['categoryId'])) {
            http_response_code(400);
            exit();
        }

        $categoryId = $_POST['categoryId'];

        $service = new Service();
        $appointments = $service->loadAvailableAppointmentsForCategory($categoryId);
        exit(json_encode($appointments));
    }
}

