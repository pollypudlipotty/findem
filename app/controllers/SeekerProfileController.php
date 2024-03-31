<?php

namespace app\controllers;

use app\helpers\Helper;
use app\models\User;
use core\Template;
use JetBrains\PhpStorm\NoReturn;

class SeekerProfileController
{
    const PROFILE_SEEKER_VIEW = "profile_seeker_view";
    const SEEKER_UPDATE_VIEW = "seeker_update_view";

    public function index(): void
    {
        $message = Helper::setFlashMessage();

        $template = new Template(self::PROFILE_SEEKER_VIEW . '.php');
        $template->loadView([
            'message' => $message,
            'nav' => Helper::setNav(),
        ]);
    }

    #[NoReturn] public function logout()
    {
        if (User::logout()) {
            Helper::redirectWithMessage(MESSAGES['logout'], 'home');
        }

        Helper::redirectWithMessage('', 'home');
    }

    public function updateProfile(): void
    {
        $template = new Template(self::SEEKER_UPDATE_VIEW . '.php');
        $template->loadView([
            'message' => Helper::setFlashMessage(),
            'nav' => Helper::setNav(),
        ]);
    }

    #[NoReturn] public function updatePassword()
    {
        if(empty($_POST['oldPassword']) || empty($_POST['newPassword'])) {
            Helper::redirectWithMessage(MESSAGES['pwUpdateError'], 'seeker_profile/updateProfile');
        }

        $user = new User();

        if ($user->updatePassword($_POST['oldPassword'], $_POST['newPassword']))
        {
            Helper::redirectWithMessage(MESSAGES['pwUpdateSuccess'], 'seeker_profile');
        }

        Helper::redirectWithMessage(MESSAGES['error'], 'seeker_profile/updateProfile');
    }
}