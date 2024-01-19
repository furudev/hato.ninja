<?php

use Symfony\Component\Dotenv\Dotenv;

require 'vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env');

session_start();

const BASE_PATH = __DIR__ . '/src/';

require_once BASE_PATH . 'Core/functions.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$router = require 'routes.php';
$router->dispatch($uri);
