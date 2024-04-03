<?php
declare(strict_types=1);
/**
 * User class mimic the structure of the user table
 * similar to a DTO data transfer object
 * 
 * @property ?int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property ?string $role
 * @property ?string $team
 */
class User {
  private ?int $user_id;
  private string $first_name;
  private string $last_name;
  private ?string $password;
  private string $email;
  private ?string $role;
  private ?string $team;

  function __construct(?int $user_id, string $first_name, string $last_name, string $email, ?string $password, ?string $role = null, ?string $team = null) {
    $this->user_id = $user_id;
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->email = $email;
    $this->password= $password;
    $this->role = $role;
    $this->team = $team;
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
  public function get_password():string {
    return $this->password;
  }
  public function get_email():string {
    return $this->email;
  }
  public function get_role():string {
    return $this->role;
  }
  public function get_team():string {
    return $this->team;
  }
}

// class UserDTO {
//   private ?int $user_id;
//   private string $first_name;
//   private string $last_name;
//   private string $email;
//   private string $password;
//   private ?int $role_id;
//   private ?int $team_id;

//   public function __construct(?int $user_id, string $first_name, string $last_name, string $email, string $password, ?int $role_id, ?int $team_id) {
//     $this->user_id = $user_id;
//     $this->first_name = $first_name;
//     $this->last_name = $last_name;
//     $this->email = $email;
//     $this->password = $password;
//     $this->role_id = $role_id;
//     $this->team_id = $team_id;
//   }
// }