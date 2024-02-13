<?php

namespace app\controllers;

use core\Template;

class RegistrationController
{
    const REGISTRATION_VIEW = "registration_view";

    public function index(): void
    {
        $template = new Template(self::REGISTRATION_VIEW . '.php');
        $template->loadView([
        ]);
    }
}