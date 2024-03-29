<?php
declare(strict_types=1);

class Response 
{
  public bool $success;
  public string $message;

  public function __construct(bool $success, string $message)
  {
    $this->success = $success;
    $this->message = $message;
  }
}
  function reason(string $err_msg)
  {
    if (str_contains($err_msg, "Duplicate entry")) {
      return "Email already exists";
    }
  }