<?php

namespace App\Models;

class Route {
  public function __construct(public string $path, public string $controller, public string $action)
  {

  }
}
