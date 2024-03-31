<?php

declare(strict_types=1);
include_once("../utils/checkers.php");
include_once("../config/pdo.php");
include("../model/response.php");

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
    sleep(1);
    header("Location: ../auth/login.php");
  }
}
