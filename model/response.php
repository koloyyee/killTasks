<?php
declare(strict_types=1);

enum HTTP:string {
  case OK = 200;
  case CREATED = 201;
  case NO_CONTENT = 204;
  case BAD_REQUEST = 400;
  case UNAUTHORIZED = 401;
  case FORBIDDEN = 403;
  case NOT_FOUND = 404;
  case METHOD_NOT_ALLOWED = 405;
  case CONFLICT = 409;
  case INTERNAL_SERVER_ERROR = 500;
}
/**
 * HTTP Response type
 * @property bool $success - response status (to be deprecated)
 * @property HTTP_CODE $code - http status code
 * @property string $message - response message
 * @property string $json - json encoded data
 */
class Response 
{
  public bool $success;
  public HTTP $code;
  public mixed $message;

  public function __construct(bool $success, mixed $message)
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