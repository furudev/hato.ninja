<?php

declare(strict_types=1);

namespace App\Models;

class Message
{
  public function __construct(public string $name, public string $email, public string $message, public string $subject)
  {
  }

  public function entries(): array {
    return [
      'name' => $this->name,
      'email' => $this->email,
      'message' => $this->message,
      'subject' => $this->subject,
    ];
  }
}
