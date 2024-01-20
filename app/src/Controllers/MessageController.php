<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Message;
use App\Core\Response;
use App\Core\Validator\Validator;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

// TODO: Add proper e-mail address from shared hosting.
// REFACTOR: Simplify code
// REFACTOR: Extract 

class MessageController extends Controller
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

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $validator->field('name', $name)->text()->words()->max(Validator::MAX_SHORT_TEXT)->required();
    $validator->field('email', $email)->email()->required();
    $validator->field('message', $message)->text()->max(Validator::MAX_LONG_TEXT)->required();

    if (!$validator->isValid()) {
      $this->response([
        'validation' => $validator->getErrors(),
        'status' => Response::NOT_ALLOWED,
      ]);

      return;
    }

    // $mail = new PHPMailer();

    // $mail->isSMTP();
    // $mail->SMTPDebug = SMTP::DEBUG_OFF;
    
    // $mail->Host = $_ENV['MAIL_HOST'];
    // $mail->Port = $_ENV['MAIL_PORT'];
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    // $mail->SMTPAuth = true;
    // $mail->AuthType = 'XOAUTH2';
    // $provider = new Google([
    //   'clientId' => $_ENV['CLIENT_ID'],
    //   'clientSecret' => $_ENV['CLIENT_SECRET'],
    // ]);

    // $mail->setOAuth(new OAuth(
    //   [
    //     'provider' => $provider,
    //     'clientId' => $_ENV['CLIENT_ID'],
    //     'clientSecret' => $_ENV['CLIENT_SECRET'],
    //     'refreshToken' => $_ENV['REFRESH_TOKEN'],
    //     'userName' => $_ENV['MAIL_USERNAME'],
    //   ]
    //   ));

    // $mail->setFrom($_ENV['MAIL_FROM_EMAIL'], $_ENV['MAIL_FROM_NAME']);
    // $mail->addReplyTo($email);
    // $mail->addAddress($_ENV['MAIL_FROM_EMAIL'], $_ENV['MAIL_FROM_NAME']);
    // $mail->Subject = "Kontakt z ngr.studio";
    // $mail->isHTML();

    // $validFormData = [
    //   'name' => $name,
    //   'email' => $email,
    //   'message' => $message,
    // ];
    
    // $_SESSION['formData'] = $validFormData;
    // $mailTemplate = file_get_contents(__DIR__ . '/../Views/email/message.html');

    // foreach ($validFormData as $key => $value) {
    //   $mailTemplate = preg_replace('/{{' . $key . '}}/', $value, $mailTemplate);
    // }

    // $mail->Body = $mailTemplate;

    // if (!$mail->send()) {
    //   $this->response([
    //     'message' => $mail->ErrorInfo,
    //     'status' => Response::NOT_ALLOWED,
    //   ]);
    //   return;
    // }
    
    $this->response([
      'message' => 'Message sent!',
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

    $data = new Message($formData['name'], $formData['email'], $formData['message']);

    $this->response([
      'data' => $data,
      'status' => Response::OK,
    ]);
  }
}
