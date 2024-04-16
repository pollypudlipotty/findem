<?php

namespace app\controllers;

use app\helpers\Helper;
use app\models\Service;
use core\Template;
use DateTime;
use JetBrains\PhpStorm\NoReturn;

class NewAppointmentController
{
    const  NEW_APPOINTMENT_VIEW = "new_appointment_view";

    public function index(): void
    {
        if ($_SESSION['user_role'] !== 2) {
            Helper::redirectWithMessage('', 'not_found');
        }

        $template = new Template(self::NEW_APPOINTMENT_VIEW . '.php');
        $template->loadView([
            'nav' => Helper::setNav(),
            'message' => Helper::setFlashMessage(),
        ]);
    }

    #[NoReturn] public function addNewAppointment(): void
    {
        if ($_SESSION['user_role'] !== 2) {
            Helper::redirectWithMessage('', 'not_found');
        }

        if (empty($_POST['date']) || empty($_POST['start_time']) || empty($_POST['duration']) || empty($_POST['fee'])) {
           Helper::redirectWithMessage(MESSAGES['missingData'], 'new_appointment');
        }

        $date = DateTime::createFromFormat('Y-m-d', $_POST['date']);
        $tomorrow = new DateTime('tomorrow');

        if ($date === false || $date <= $tomorrow) {
            Helper::redirectWithMessage(MESSAGES['invalidDate'], 'new_appointment');
        }

        $pattern = '/^(0[7-9]|1\d|2[0-2]):(00|30)$|^22:30$/';

        if (!preg_match($pattern, $_POST['start_time'])) {
            Helper::redirectWithMessage(MESSAGES['invalidTime'], 'new_appointment');
        }

        $validDurations = array(0.5, 1, 1.5, 2, 2.5, 3);

        if (!in_array($_POST['duration'], $validDurations)) {
            Helper::redirectWithMessage(MESSAGES['invalidDuration'], 'new_appointment');
        }

        $fee = filter_var($_POST['fee'], FILTER_VALIDATE_INT);

        if ($fee === false || $fee < 0) {
            Helper::redirectWithMessage(MESSAGES['invalidFee'], 'new_appointment');
        }

        $service = new Service();

        $service->addAppointment([
            'date' => $_POST['date'],
            'start_time' => $_POST['start_time'],
            'duration' => $_POST['duration'],
            'fee' => $_POST['fee'],
        ]);
    }
}
