<?php

declare(strict_types=1);
// include("../config/pdo.php");
include("../libs/checkers.php");

  // $first_name= sanitize($_POST['first_name'], Input::string);
  // $last_name= sanitize($_POST['last_name'], Input::string);
  // $email= sanitize($_POST['email'], Input::email);
  // $password= sanitize($_POST['password'], Input::password);

  // $sql = 'INSERT INTO user (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)';
  // $stmt = $conn->prepare($sql);
  // $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
  // $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
  // $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  // $stmt->bindParam(":password", $password, PDO::PARAM_STR);
  // echo $stmt;
  // return false;
  // return $stmt->execute();

class Auth{
  static function login( PDO $conn): void {
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
          $_SESSION['session_id'] = session_create_id($r['first_name'] .  $r['last_name'] );
          $_SESSION['email'] = $email;
          header("Location: ../private/dashboard.php");
        }
      }
    }
  }
  static function register(PDO $conn, string $first_name, string $last_name, string $email, string $password): bool{
    $sql = 'INSERT INTO user (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(":password", $password, PDO::PARAM_STR);
    echo $stmt;
    return false;
    // return $stmt->execute();
  }
}