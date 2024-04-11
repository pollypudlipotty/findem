<?php

namespace app\controllers;

use app\helpers\Helper;
use core\Template;

class DataProtectionController
{
    const  DATA_PROTECTION_VIEW = "data_protection_view";

    public function index(): void
    {
        $template = new Template(self::DATA_PROTECTION_VIEW . '.php');
        $template->loadView([
            'nav' => Helper::setNav(),
        ]);
    }
}
