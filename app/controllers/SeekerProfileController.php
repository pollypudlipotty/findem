<?php

namespace app\controllers;

use app\helpers\Helper;
use app\models\Service;
use app\models\User;
use core\Template;
use JetBrains\PhpStorm\NoReturn;

class SeekerProfileController
{
    const PROFILE_SEEKER_VIEW = "profile_seeker_view";
    const SEEKER_UPDATE_VIEW = "seeker_update_view";

    public function index(): void
    {
        if ($_SESSION['user_role'] !== 1) {
            Helper::redirectWithMessage('', 'not_found');
        }

        $service = new Service();
        $user = new User();

        $template = new Template(self::PROFILE_SEEKER_VIEW . '.php');
        $template->loadView([
            'message' => Helper::setFlashMessage(),
            'nav' => Helper::setNav(),
            'reservations' => $service->getReservationsOfUser(),
            'pastReservations' => $service->getPastReservationsOfUser(),
            'userData' => $user->getUserData(),
        ]);
    }

    #[NoReturn] public function logout(): void
    {
        if (User::logout()) {
            Helper::redirectWithMessage(MESSAGES['logout'], 'home');
        }

        Helper::redirectWithMessage('', 'home');
    }

    public function updateProfile(): void
    {
        if ($_SESSION['user_role'] !== 1) {
            Helper::redirectWithMessage('', 'not_found');
        }

        $template = new Template(self::SEEKER_UPDATE_VIEW . '.php');
        $template->loadView([
            'message' => Helper::setFlashMessage(),
            'nav' => Helper::setNav(),
        ]);
    }

    #[NoReturn] public function updatePassword(): void
    {
        if ($_SESSION['user_role'] !== 1) {
            Helper::redirectWithMessage('', 'not_found');
        }

        if(empty($_POST['oldPassword']) || empty($_POST['newPassword']) || empty($_POST['newPasswordAgain'])) {
            Helper::redirectWithMessage(MESSAGES['pwUpdateError'], 'seeker_profile/updateProfile');
        }

        if ($_POST['newPassword'] !== $_POST['newPasswordAgain']) {
            Helper::redirectWithMessage(MESSAGES['pwMatch'], 'seeker_profile/updateProfile');
        }

        $user = new User();

        if ($user->updatePassword($_POST['oldPassword'], $_POST['newPassword'], 'seeker_profile'))
        {
            Helper::redirectWithMessage(MESSAGES['pwUpdateSuccess'], 'seeker_profile');
        }

        Helper::redirectWithMessage(MESSAGES['error'], 'seeker_profile/updateProfile');
    }

    #[NoReturn] public function deleteProfile(): void
    {
        if (!empty($_SESSION['user'])) {
            $user = new User();
            $user->deleteProfile($_SESSION['user'], 'seeker_profile');
        }

        Helper::redirectWithMessage('', 'home');
    }
}
