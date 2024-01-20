<?php

declare(strict_types=1);

namespace App\Core\Validator;

use App\Core\Validator\Exceptions\InvalidFieldException;


class Validator {
  private array $errors = [];
  private string $field;
  private string $fieldName;
  
  const MAX_SHORT_TEXT = 65;
  const MAX_LONG_TEXT = 2000;

  public function __construct() {}

  public function field(string $name, string $value): self {
    $this->fieldName = $name;
    $this->field = $value;

    if (is_null($this->field)) {
      throw new InvalidFieldException("$this->fieldName does not exist.");
    }

    return $this;
  }

  public function required(): self {
    if (is_null($this->field) || empty($this->field)) {
      $this->errors[$this->fieldName][] = [
        'message' => "$this->fieldName cannot be empty.",
      ];
    }

    return $this;
  }

  public function empty(): self {
    if (!empty($this->field)) {
      $this->errors[$this->fieldName][] = [
        'message' => "$this->fieldName must be empty.",
      ];
    }

    return $this;
  }

  public function text(): self {
    htmlspecialchars($this->field);

    return $this;
  }

  public function words(): self {
    $options = [
      'regexp' => "/^[a-zA-Z]+$/",
    ];

    if (!filter_var($this->field, FILTER_VALIDATE_REGEXP, ['options' => $options])) {
      $this->errors[$this->fieldName][] = [
        'message' => "$this->fieldName does not contains only words",
      ];
    }

    return $this;
  }

  public function max(int $length): self {
    if (strlen($this->field) > $length) {
      $this->errors[$this->fieldName][] = [
        'message' => "$this->fieldName cannot be longer than $length."
      ];
    }

    return $this;
  }

  public function email(): self {
    $sanitizedEmail = filter_var($this->field, FILTER_SANITIZE_EMAIL);

    if (!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
      $this->errors[$this->fieldName][] = [
        'message' => "$this->fieldName is considered to be invalid e-mail address.",
      ];
    }

    return $this;
  }

  public function isValid(): bool {
    if (count($this->errors) > 0) {
      return false;
    }

    return true;
  }

  public function getErrors(): array {
    return $this->errors;
  }
}
