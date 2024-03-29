<?php
declare(strict_types=1);
include("../model/user.php");
// CRUD user
class UserService {
  private PDO $pdo;
  function __construct(PDO $pdo) {
    $this->pdo = $pdo;
  }
  public function create_user(PDO $conn, string $first_name, string $last_name, string $email, string $password): Response 
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
}
?>