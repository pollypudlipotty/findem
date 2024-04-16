<?php

namespace app\controllers;

use app\helpers\Helper;
use app\models\User;
use core\Template;
use JetBrains\PhpStorm\NoReturn;

class LoginController
{
    const LOGIN_VIEW = "login_view";

    public function index(): void
    {
        if (isset($_SESSION['user'])) {
            Helper::redirectWithMessage('', 'home');
        }

        $template = new Template(self::LOGIN_VIEW . '.php');
        $template->loadView([
            'message' => Helper::setFlashMessage(),
            'nav' => Helper::setNav(),
        ]);
    }

    #[NoReturn] public function userLogin(): void
    {
        if (empty($_POST['email']) || empty($_POST['pass'])) {
            Helper::redirectWithMessage(MESSAGES['missingData'], 'login');
        }

        $user = new User();
        $user->login($_POST['email'], $_POST['pass']);
    }
}
