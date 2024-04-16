<?php
require 'vendor/autoload.php';
require_once 'env.php';

use core\Router;

session_start();

$router = new Router();
$router->match();
