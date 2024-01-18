<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Response;
use App\Core\Controller;

class IndexController extends Controller
{
  public function index()
  {
    $response = [
      'message' => 'Index page',
      'status'  => Response::OK,
    ];

    $this->response($response);
  }
}
