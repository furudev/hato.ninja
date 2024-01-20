<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Mailer\Mailer;
use App\Core\Response;
use App\Core\Validator\Validator;
use App\Models\Message;
use Exception;


class ContactController extends Controller
{
  public function post()
  {
    if (!isset($_POST)) {
      return;
    }

    $validator = new Validator();

    $validator->field('firstname', $_POST['firstname'])->empty();
    if (!$validator->isValid()) {
      $this->response([
        'status' => Response::NOT_ALLOWED
      ]);
      die();
      return;
    }

    $message = new Message(
      name: $_POST['name'],
      email: $_POST['email'],
      message: $_POST['message'],
      subject: $_ENV['MAIL_SUBJECT'],
    );

    $validator->field('name', $message->name)->text()->words()->max(Validator::MAX_SHORT_TEXT)->required();
    $validator->field('email', $message->email)->email()->required();
    $validator->field('message', $message->message)->text()->max(Validator::MAX_LONG_TEXT)->required();

    if (!$validator->isValid()) {
      $this->response([
        'validation' => $validator->getErrors(),
        'status' => Response::NOT_ALLOWED,
      ]);

      return;
    }

    $mailer = new Mailer(subject: $message->subject, to: $message->email, template: 'message.html');

    try {
      $mailer->variables($message->entries())->send();

      $this->response([
        'message' => 'Message sent successfully',
        'status' => Response::OK,
      ]);
    } catch (Exception $exception) {
      $this->response([
        'message' => $exception->getMessage(),
        'status' => Response::NOT_ALLOWED,
      ]);
    }
  }
}
