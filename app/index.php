<?php

require 'vendor/autoload.php';

session_start();

const BASE_PATH = __DIR__ . '/src/';

require_once BASE_PATH . 'Core/functions.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$router = require 'routes.php';
$router->dispatch($uri);
