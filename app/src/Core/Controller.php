<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\JSON;

class Controller
{
  protected function render(string $view, ?array $attributes = [])
  {
    view($view, $attributes);
  }

  protected function response(mixed $data)
  {
    $json = new JSON();

    $json->response($data);
  }
}
