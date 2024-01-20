<?php

declare(strict_types=1);

namespace App\Core\Mailer;

use App\Core\Mailer\Exceptions\{TemplateNotFoundException, MailerFailedException};
use PHPMailer\PHPMailer\{PHPMailer, SMTP};

class Mailer {
  private PHPMailer $mail;
  private string $templateFile;
  private array $templateVariables;

  public function __construct(private string $subject, private string $to, private string $template) {
    $this->mail = new PHPMailer();

    $this->mail->isSMTP();
    $this->mail->SMTPDebug = SMTP::DEBUG_OFF;
    $this->mail->Host = $_ENV['MAIL_HOST'];
    $this->mail->Port=  $_ENV['MAIL_PORT'];
    $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $this->mail->SMTPAuth = true;
    $this->mail->Username = $_ENV['MAIL_USERNAME'];
    $this->mail->Password = $_ENV['MAIL_PASSWORD'];
    $this->mail->setFrom($_ENV['MAIL_FROM_EMAIL'], $_ENV['MAIL_FROM_NAME']);
    $this->mail->addAddress($_ENV['MAIL_FROM_EMAIL'], $_ENV['MAIL_FROM_NAME']);
    $this->mail->addReplyTo($this->to);
    $this->mail->CharSet = 'UTF-8';
    $this->mail->Encoding = 'base64';
    $this->mail->isHTML(true);
    $this->mail->Subject = $this->subject;
  }

  private function getTemplate(): self {
    $this->templateFile = file_get_contents(__DIR__ . '/../../Views/email/' . $this->template);

    if (!$this->templateFile) {
      throw new TemplateNotFoundException("E-mail template $this->template does not exist in directory /Views/email");
    }

    return $this;
  }

  private function injectTemplateVariables(): self {
    foreach ($this->templateVariables as $key => $value) {
      $this->templateFile = preg_replace('/{{' . $key . '}}/', $value, $this->templateFile);
    }

    return $this;
  }

  public function variables(array $variables): self {
    $this->templateVariables = $variables;

    return $this;
  }

  private function prepare(): self {
    $this->getTemplate();
    $this->injectTemplateVariables($this->templateVariables);

    $this->mail->Body = $this->templateFile;

    return $this;
  }

  
  public function send(): void {
    $this->prepare();


    if (!$this->mail->send()) {
      throw new MailerFailedException("Mailer failed. Error details: " . $this->mail->ErrorInfo);
    }
  }
}
