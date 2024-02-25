<?php

namespace app\controllers;

use app\helpers\Helper;
use app\models\User;
use core\Template;

class LoginController
{
    const LOGIN_VIEW = "login_view";

    public function index(): void
    {
        $message = Helper::setFlashMessage();

        $template = new Template(self::LOGIN_VIEW . '.php');
        $template->loadView([
            'message' => $message,
        ]);
    }

    public function userLogin(): void
    {
        if (empty($_POST['email']) || empty($_POST['pass'])) {
            Helper::redirectWithMessage(MESSAGES['missingData'], 'login');
        }

        $user = new User();
        $user->login($_POST['email'], $_POST['pass']);
    }
}