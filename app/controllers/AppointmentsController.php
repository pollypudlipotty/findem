<?php

namespace app\controllers;

use app\helpers\Helper;
use app\models\Service;
use core\Template;
use JetBrains\PhpStorm\NoReturn;

class AppointmentsController
{
    const  APPOINTMENTS_VIEW = "appointments_view";

    public function index(): void
    {
        if (!isset($_SESSION['user'])) {
            Helper::redirectWithMessage('','not_found');
        }

        $service = new Service();

        $template = new Template(self::APPOINTMENTS_VIEW . '.php');
        $template->loadView([
            'nav' => Helper::setNav(),
            'appointments' => $service->loadAvailableAppointments(),
            'services' => $service->loadCategories(),
        ]);
    }

    #[NoReturn] public function reserveAppointment(): void
    {
        if (empty($_POST['appointmentId']) || !isset($_SESSION['user'])) {
            Helper::redirectWithMessage('', 'home');
        }

        $service = new Service();
        if ($service->reserveAppointment($_POST['appointmentId'], $_SESSION['user'])) {
            $_SESSION['message'] = MESSAGES['appointmentReserved'];
            http_response_code(204);
            exit();
        }

        http_response_code(400);
        exit();
    }

    #[NoReturn] public function sortCategories(): void
    {
        if (empty($_POST['categoryId'])) {
            http_response_code(400);
            exit();
        }

        $categoryId = $_POST['categoryId'];

        $service = new Service();
        $appointments = $service->loadAvailableAppointmentsForCategory($categoryId);
        exit(json_encode($appointments));
    }
}
