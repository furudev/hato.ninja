<?php

declare(strict_types=1);

use Core\JSON;
use Core\Response;

$data = [
  'message' => 'Contact page',
  'status'  => Response::OK,
];

return JSON::response($data);
