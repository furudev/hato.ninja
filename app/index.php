<?php

const BASE_PATH = __DIR__ . '/';

use Core\Router;

require_once BASE_PATH . 'config.php';
require_once BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
  $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

  require base_path("$class.php");
});

$router = new Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
