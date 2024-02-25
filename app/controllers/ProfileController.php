<?php

namespace app\controllers;

use app\helpers\Helper;
use core\Template;

class ProfileController
{
    const PROFILE_VIEW = "profile_view";

    public function index(): void
    {
        $message = Helper::setFlashMessage();

        $template = new Template(self::PROFILE_VIEW . '.php');
        $template->loadView([
            'message' => $message,
        ]);
    }
}
