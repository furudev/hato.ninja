<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Response;

class ContactController extends Controller
{
  public function index()
  {
    $response = [
      'message' => 'Contact page',
      'status'  => Response::OK,
    ];

    $this->response($response);
  }
}
