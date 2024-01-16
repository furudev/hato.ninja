<?php

declare(strict_types=1);

namespace Core;

class JSON
{
  public static function response(mixed $data)
  {
    echo json_encode($data);
    exit();
  }
}
