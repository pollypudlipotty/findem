<?php

namespace app\helpers;

use JetBrains\PhpStorm\NoReturn;

class Helper
{
    #[NoReturn] public static function redirectWithMessage(string $message, string $location): void
    {
        $_SESSION['message'] = $message;
        header("Location: /" . $location);
        exit();
    }

    public static function setFlashMessage(): string
    {
        if (!isset($_SESSION['message'])) {
            return '';
        }

        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        return $message;
    }

    public static function setNav(): string
    {
        if (isset($_SESSION['user_role'])) {
            $nav = match ($_SESSION['user_role']) {
                2 => "provider_nav.php",
                1 => "seeker_nav.php",
                default => "guest_nav.php",
            };
        } else {
            $nav = "guest_nav.php";
        }

        return $nav;
    }
}
