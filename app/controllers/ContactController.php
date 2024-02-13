<?php

namespace app\controllers;

use core\Template;

class ContactController
{
    const CONTACT_VIEW = "contact_view";

    public function index(): void
    {
        $template = new Template(self::CONTACT_VIEW . '.php');
        $template->loadView();
    }
}