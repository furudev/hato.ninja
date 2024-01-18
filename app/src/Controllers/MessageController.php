<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Message;
use App\Core\Response;

// REFACTOR: Extract Validation to the separate class Validator.
// REFACTOR: Simplify code

class MessageController extends Controller
{
  public function post()
  {
    if (!isset($_POST)) {
      return;
    }

    if (!empty($_POST['firstname'])) {
      $this->response([
        'status' => Response::NOT_ALLOWED
      ]);
      die();
      return;
    }

    $errors = [];
    $name = htmlspecialchars($_POST['name']);
    if (is_null($name) || empty($name)) {
      $errors['name']['message'] = 'Name must be filled.';
    }

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!$email) {
      $errors['email']['message'] = 'E-mail is considered not valid.';
    }

    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!$email) {
      $errors['email']['message'] = 'E-mail is not valid.';
    }

    $message = htmlspecialchars($_POST['message']);

    if (is_null($message) || empty($message)) {
      $errors['message']['message'] = 'Message must be filled.';
    }

    if (count($errors) > 0) {
      $this->response([
        'validation' => $errors,
        'status' => Response::NOT_ALLOWED,
      ]);

      return;
    }

    $_SESSION['formData'] = [
      'name' => $name,
      'email' => $email,
      'message' => $message,
    ];

    $this->response([
      'status' => Response::OK,
    ]);
  }

  public function get()
  {
    if (!isset($_SESSION['formData'])) {
      $this->response([
        'message' => 'No form data found.',
        'status' => Response::OK,
      ]);
      return;
    }

    $formData = $_SESSION['formData'];

    $data = new Message(name: $formData['name'], email: $formData['email'], message: $formData['message']);

    $this->response([
      'data' => $data,
      'status' => Response::OK,
    ]);
  }
}
