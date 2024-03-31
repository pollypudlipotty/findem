<?php

namespace app\controllers;

use app\helpers\Helper;
use app\models\User;
use core\Template;

class ProviderProfileController
{
    const PROFILE_PROVIDER_VIEW = "profile_provider_view";

    public function index(): void
    {
        $message = Helper::setFlashMessage();

        $template = new Template(self::PROFILE_PROVIDER_VIEW . '.php');
        $template->loadView([
            'message' => $message,
            'nav' => Helper::setNav(),
        ]);
    }

    public function logout ()  {
        if (User::logout()) {
            Helper::redirectWithMessage(MESSAGES['logout'], 'home');
        }

        Helper::redirectWithMessage('', 'home');
    }
}
