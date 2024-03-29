<?php

declare(strict_types=1);

namespace App\Core;

class Json
{
  public function __construct()
  {
    header('Content-Type: application/json');
  }
  public function response(mixed $data)
  {
    echo json_encode($data);
    exit();
  }
}
