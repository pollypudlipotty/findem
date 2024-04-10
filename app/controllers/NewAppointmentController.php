<?php

namespace app\controllers;

use app\helpers\Helper;
use core\Template;

class NewAppointmentController
{
    const  NEW_APPOINTMENT_VIEW = "new_appointment_view";

    public function index(): void
    {
        $template = new Template(self::NEW_APPOINTMENT_VIEW . '.php');
        $template->loadView([
            'nav' => Helper::setNav(),
        ]);
    }
}