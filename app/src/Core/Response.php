<?php

declare(strict_types=1);

namespace App\Core;

class Response
{
  const OK = [
    'code' => 200,
    'message' => 'ok',
  ];
  const FORBIDDEN = [
    'code' => 403,
    'message' => 'forbidden',
  ];
  const NOT_FOUND = [
    'code' => 404,
    'message' => 'not found'
  ];
  const NOT_ALLOWED = [
    'code' => 405,
    'message' => 'not allowed',
  ];
}
