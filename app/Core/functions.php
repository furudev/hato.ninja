<?php

declare(strict_types=1);

use Core\JSON;
use Core\Response;

function dd(mixed $value): void
{
  echo "<pre>";
  var_dump($value);
  echo "</pre>";

  die();
}

function urlIs(string $value): bool
{
  return $_SERVER['REQUEST_URI'] === $value;
}

function base_path($path)
{
  return BASE_PATH . $path;
}

function abort($code = 403): void
{
  http_response_code($code);

  $data = [
    'message' => 'Not allowed',
    'status' => Response::FORBIDDEN,
  ];

  JSON::response($data);
  die();
}
