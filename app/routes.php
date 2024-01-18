<?php

declare(strict_types=1);

use App\Core\Router;
use App\Controllers\IndexController;
use App\Controllers\ContactController;
use App\Controllers\FormController;
use App\Controllers\MessageController;

$router = new Router();

$router->addRoute('/api', IndexController::class, 'index');
$router->addRoute('/api/contact', ContactController::class, 'index');
$router->addRoute('/form', FormController::class, 'index');
$router->addRoute('/api/message/send', MessageController::class, 'post');
$router->addRoute('/api/message', MessageController::class, 'get');

return $router;
