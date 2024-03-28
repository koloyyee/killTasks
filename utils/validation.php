<?php 
declare(strict_types=1);
enum RegisterFields {
  case first_name;
  case last_name;
  case email;
  case password;
}

function validate(string $input, RegisterFields $field): bool
{
  $email_regex= "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
  $input = trim($input);
  switch($field) {
    case RegisterFields::email:
      return !empty($input) && preg_match($email_regex, $input);
    case RegisterFields::password:
      return strlen($input) >= 8;
    default:
      return !empty($input);
  }
}