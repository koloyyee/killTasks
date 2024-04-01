<?php 
declare(strict_types=1);
enum Fields {
  case first_name;
  case last_name;
  case email;
  case password;
  case number;
}
/**
 * Validate input data
 * @param string $input
 * @param Fields $field @see Fields
 * @return bool
 */
function validate(string $input, Fields $field): bool
{
  $email_regex= "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

  $input = is_numeric($input) ? $input : trim($input);
  switch($field) {
    case Fields::number:
      return $input> 0;
    case Fields::email:
      return !empty($input) && preg_match($email_regex, $input);
    case Fields::password:
      return strlen($input) >= 8;
    default:
      return !empty($input);
  }
}