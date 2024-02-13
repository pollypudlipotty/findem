<?php

namespace app\controllers;

use core\Template;

class AboutUsController
{
    const  ABOUT_US_VIEW = "about_us_view";

    public function index(): void
    {
        $template = new Template(self::ABOUT_US_VIEW . '.php');
        $template->loadView([]);
    }
}