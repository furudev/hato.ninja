<?php

declare(strict_types=1);

namespace App\Models;

class Message
{
  public function __construct(public string $name, public string $email, public string $message)
  {
  }
}
