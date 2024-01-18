<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\JSON;
use App\Core\Response;

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

function base_path(string $path): string
{
  return BASE_PATH . $path;
}

function abort(int $code = 404): void
{
  http_response_code($code);

  $data = [
    'status' => Response::FORBIDDEN,
  ];

  $json = new JSON();

  $json->response($data);
  die();
}

function view(string $path, array $attributes = []): void
{
  extract($attributes);

  require_once base_path("views/$path");
}