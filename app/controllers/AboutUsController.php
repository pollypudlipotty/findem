<?php

namespace app\controllers;

use app\helpers\Helper;
use core\Template;

class AboutUsController
{
    const  ABOUT_US_VIEW = "about_us_view";

    public function index(): void
    {
        $template = new Template(self::ABOUT_US_VIEW . '.php');
        $template->loadView([
            'nav' => Helper::setNav(),
        ]);
    }
}
