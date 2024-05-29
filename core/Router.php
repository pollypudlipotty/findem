<?php

namespace core;

use app\controllers\AboutUsController;
use app\controllers\ContactController;
use app\controllers\HomeController;
use app\controllers\LoginController;
use app\controllers\NotFoundController;
use app\controllers\ProviderProfileController;
use app\controllers\RegistrationController;
use app\controllers\SeekerProfileController;
use app\controllers\NewAppointmentController;
use app\controllers\QuestionAndAnswerController;
use app\controllers\DataProtectionController;
use app\controllers\AppointmentsController;

class Router
{
    private array $requestArray;

    private const ROUTES = [
        'home' => ['controller' => HomeController::class],
        'registration' => ['controller' => RegistrationController::class],
        'login' => ['controller' => LoginController::class],
        'about_us' => ['controller' => AboutUsController::class],
        'contact' => ['controller' => ContactController::class],
        'seeker_profile' => ['controller' => SeekerProfileController::class],
        'service_profile' => ['controller' => ProviderProfileController::class],
        'new_appointment' => ['controller' => NewAppointmentController::class],
        'question_and_answer' => ['controller' => QuestionAndAnswerController::class],
        'data_protection' => ['controller' => DataProtectionController::class],
        'appointments' => ['controller' => AppointmentsController::class],
    ];

    private const NOT_FOUND = ['controller' => NotFoundController::class];

    public function __construct()
    {
        $request = $_SERVER['REQUEST_URI'] ?? '/';
        $this->requestArray = array_filter(explode('/', $request));
    }

    public function match(): void
    {
        $controllerName = self::ROUTES['home']['controller'];
        $method = 'index';

        if ($this->requestArray) {
            foreach (self::ROUTES as $key => $route) {
                if ($key === $this->requestArray[1]) {
                    $controllerName = $route['controller'];
                    $method = $this->requestArray[2] ?? 'index';

                    $paramNumber = count($this->requestArray);
                    $firstParamIndex = 3;

                    for ($i = $firstParamIndex; $i <= $paramNumber; $i++) {
                        $args[] = $this->requestArray[$i] ?? '';
                    }
                    break;
                }
                $controllerName = self::NOT_FOUND['controller'];
            }
        }

        $args = !empty($args) ? $args : [];

        $controller = new $controllerName();

        try {
            if (!method_exists($controller, $method)) {
                $wrongMethod = $method;
                $this->callNotFound($controller, $method);
                throw new \Exception("Method: " . $wrongMethod . " doesn't exist.");
            }
        } catch (\Exception $exception) {
            error_log($exception->getMessage(), 0);
        } finally {
            $args ? $controller->$method(...$args) : $controller->$method();
        }
    }

    public function callNotFound(&$controller, &$method): void
    {
        $controllerName = self::NOT_FOUND['controller'];
        $controller = new $controllerName;
        $method = 'index';
    }
}
