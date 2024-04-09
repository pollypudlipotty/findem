<?php

namespace app\controllers;

use app\helpers\Helper;
use core\Template;

class AppointmentsController
{
    const  APPOINTMENTS_VIEW = "appointments_view";

    public function index(): void
    {
        $template = new Template(self::APPOINTMENTS_VIEW . '.php');
        $template->loadView([
            'nav' => Helper::setNav(),
        ]);
    }
}