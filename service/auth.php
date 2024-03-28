<?php

declare(strict_types=1);
include_once("../utils/checkers.php");


class Auth
{
  static function login(PDO $conn): void
  {
    $password = $_POST['password'];
    $email = $_POST['email'];
    $sql = "SELECT first_name, last_name, password FROM user WHERE email = '$email'";
    $row = $conn->query($sql);
    if (!empty($row)) {
      foreach ($row as $r) {
        if (!password_verify($password, $r['password'])) {
          header("Location: ../auth/login.php");
        } else {
          $_SESSION['first_name'] = $r['first_name'];
          $_SESSION['last_name'] = $r['last_name'];
          $_SESSION['session_id'] = session_create_id($r['first_name'] .  $r['last_name']);
          $_SESSION['email'] = $email;
          header("Location: ../private/dashboard.php");
        }
      }
    }
  }
  static function register(PDO $conn, string $first_name, string $last_name, string $email, string $password):array 
  {
    try {
      $sql = 'INSERT INTO user (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
      $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(":password", $password, PDO::PARAM_STR);
      $stmt->execute();
      return array("success" => true, "message" => "User registered successfully");
    } catch (PDOException $e) {
      return array("success" => false, "message" => reason($e->getMessage()));
    }
  }
}
  function reason(string $err_msg) {
    if(str_contains($err_msg, "Duplicate entry")) {
      return "Email already exists";
    }
  }
