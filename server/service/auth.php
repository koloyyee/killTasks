<?php

declare(strict_types=1);
include_once("../server/utils/checkers.php");
include_once("../server/config/pdo.php");
include_once("../server/model/response.php");

/**
 * AuthService class
 * handles login and logout
 * 
 * Dependency Injection PdoDao class
 * @see PdoDao
 */
class AuthService
{
  private PDO $conn;
  public function __construct(PdoDao $pdo= new PdoDao())
  {
    $this->conn = $pdo->get_pdo();  
  }
  public function login(string $email, string $password): Response
  {
    session_start();
    $sql = "SELECT first_name, last_name, password FROM user WHERE email = '$email'";
    $stmt = $this->conn->query($sql);
    $user = $stmt->fetch();
    if (empty($user)) {
      return new Response(false, "No user found");
    } elseif (!password_verify($password, $user['password'])) {
      return new Response(false, "Invalid email or password");
    } else {
      $_SESSION['first_name'] = $user['first_name'];
      $_SESSION['last_name'] = $user['last_name'];
      $_SESSION['session_id'] = session_create_id($user['first_name'] .  $user['last_name']);
      $_SESSION['email'] = $email;
      return new Response(true, "OK");
    }
  }

  public static function logout()
  {
    session_start();
    echo "You have been logged out";
    echo "<br>Redirecting to login page...<br>";
    session_destroy();
    header("Location: ../auth/login.php");
  }
}
