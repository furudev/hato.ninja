<?php

require 'vendor/autoload.php';

session_start();

const BASE_PATH = __DIR__ . '/src/';

require_once BASE_PATH . 'Core/functions.php';

// TODO: add PHPMailer
// TODO: connect PHPMailer with Controllers
// TODO: send test e-mail message

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$router = require 'routes.php';
$router->dispatch($uri);
