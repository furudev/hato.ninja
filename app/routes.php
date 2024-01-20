<?php

declare(strict_types=1);

use App\Core\Router;
use App\Models\Route;
use App\Controllers\IndexController;
use App\Controllers\ContactController;

// [i]: uncomment to enable debugging with form.view.php on `/form` route.
// use App\Controllers\FormController;


$router = new Router();

$router->addRoute(new Route('/api', IndexController::class, 'index'));
$router->addRoute(new Route('/api/contact', ContactController::class, 'post'));

// [i]: uncomment to enable debugging with form.view.php on `/form` route.
// $router->addRoute(new Route('/form', FormController::class, 'index'));

return $router;
