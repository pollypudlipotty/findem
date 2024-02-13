<?php

namespace app\controllers;

use core\Template;

class LoginController
{
    const LOGIN_VIEW = "login_view";

    public function index(): void
    {
        $template = new Template(self::LOGIN_VIEW . '.php');
        $template->loadView([]);
    }
}