<?php
declare(strict_types=1);
class User {
  private int $user_id;
  private string $first_name;
  private string $last_name;
  private string $email;
  private string $role_id;
  private string $team_id;

  function __construct(int $user_id, string $first_name, string $last_name, string $email) {
    $this->user_id = $user_id;
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->email = $email;
  }

  public function get_user_id():int {
    return $this->user_id;
  }
  public function get_first_name():string {
    return $this->first_name;
  }
  public function get_last_name():string {
    return $this->last_name;
  }
  public function get_email():string {
    return $this->email;
  }
}