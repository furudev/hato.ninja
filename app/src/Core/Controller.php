<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Json;

class Controller
{
  // [i]: uncomment to enable debugging with form.view.php on `/form` route.
  // protected function render(string $view, ?array $attributes = [])
  // {
  //   view($view, $attributes);
  // }

  protected function response(array $data)
  {
    $json = new Json();

    $json->response($data);
  }
}
