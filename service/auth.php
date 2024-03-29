<?php

declare(strict_types=1);
include_once("../utils/checkers.php");
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

class Auth
{

  static function login(PDO $conn, string $email, string $password): Response
  {
    session_start();
    $sql = "SELECT first_name, last_name, password FROM user WHERE email = '$email'";
    $stmt = $conn->query($sql);
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
      return new Response(true, "Welcome back! $user[first_name] $user[last_name]");
    }
  }

  static function register(PDO $conn, string $first_name, string $last_name, string $email, string $password): array
  {
    try {
      $sql = 'INSERT INTO user (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
      $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(":password", $password, PDO::PARAM_STR);
      $stmt->execute();
      return new Response(true, "User registered successfully");
    } catch (PDOException $e) {
      return new Response(false, reason($e->getMessage()));
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

  function reason(string $err_msg)
  {
    if (str_contains($err_msg, "Duplicate entry")) {
      return "Email already exists";
    }
  }