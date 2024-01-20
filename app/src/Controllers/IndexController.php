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
      'message' => 'Hato.ninja API is working properly',
      'status'  => Response::OK,
    ];

    $this->response($response);
  }
}
