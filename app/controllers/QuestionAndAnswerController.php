<?php

namespace app\controllers;

use app\helpers\Helper;
use core\Template;

class QuestionAndAnswerController
{
    const  QUESTION_AND_ANSWER_VIEW = "question_and_answer_view";

    public function index(): void
    {
        $template = new Template(self::QUESTION_AND_ANSWER_VIEW . '.php');
        $template->loadView([
            'nav' => Helper::setNav(),
        ]);
    }
}
