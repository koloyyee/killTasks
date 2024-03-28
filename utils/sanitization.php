<?php
declare(strict_types=1);

enum Input
{
  case string;
  case email;
  case password;
};

function sanitize(string $input, Input $type) : string 
{
  $input = trim($input);
  switch ($type) {
    case Input::email:
      return filter_var($input, FILTER_VALIDATE_EMAIL);
    case Input::password:
      return password_hash($input, PASSWORD_DEFAULT);
    case Input::string:
    default:
      return filter_var($input, FILTER_SANITIZE_SPECIAL_CHARS);
  }
}