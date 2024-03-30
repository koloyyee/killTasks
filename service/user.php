<?php
declare(strict_types=1);
include("../model/user.php");
include("../model/response.php");
// CRUD user
class UserService
{
  private PDO $conn;
  function __construct(PDO $pdo)
  {
    $this->conn = $pdo;
  }
  public function create_user(UserDTO $user): Response
  {
    try {
      $sql = 'INSERT INTO user 
      (first_name, last_name, email, password) 
      VALUES (:first_name, :last_name, :email, :password)
      ';

      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':first_name', $user->first_name, PDO::PARAM_STR);
      $stmt->bindParam(':last_name', $user->last_name, PDO::PARAM_STR);
      $stmt->bindParam(':email', $user->email, PDO::PARAM_STR);
      $stmt->bindParam(":password", $user->password, PDO::PARAM_STR);
      $stmt->execute();
      return new Response(true, "User registered successfully");
    } catch (PDOException $e) {
      return new Response(false, $e->getMessage());
    }
  }

  public function get_user_by_email(string $email): User | null
  {
    $sql = " SELECT 
    u.user_id, u.first_name, u.last_name, u.email, u.password,
    r.role_name,
    t.team_name
     FROM 
    user u
    JOIN role r ON u.role_id = r.role_id
    JOIN team t ON u.team_id = t.team_id
    WHERE email = :email";
    try {

      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result) {
        return  new User(
          $result['user_id'],
          $result['first_name'],
          $result['last_name'],
          $result['email'],
          $result['role_name'],
          $result['team_name']
        );
      }
      return null;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function get_users()
  {
    $users = [];
    $sql = "SELECT 
    u.user_id, u.first_name, u.last_name, u.email, u.password,
    r.role_name,
    t.team_name
     FROM 
    user u
    JOIN role r ON u.role_id = r.role_id
    JOIN team t ON u.team_id = t.team_id";
    try {

      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
        $user = new User(
          $row['user_id'],
          $row['first_name'],
          $row['last_name'],
          $row['email'],
          $row['role_name'],
          $row['team_name']
        );
        array_push($users, $user);
      }
      return $users;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
  //-------------------- TO BE TESTED! -------------------------
  public function update_role(int $role_id)
  {
    $sql = "UPDATE user SET role_id = :role_id WHERE user_id = :user_id";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
      $stmt->execute();
      return new Response(true, "Role updated successfully");
    } catch (PDOException $e) {
      return new Response(false, $e->getMessage());
    }
  }
  public function update_team(?int $team_id)
  {
    $sql = "UPDATE user SET team_id = :team_id WHERE user_id = :user_id";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':team_id', $team_id, PDO::PARAM_INT);
      $stmt->execute();
      return new Response(true, "Team updated successfully");
    } catch (PDOException $e) {
      return new Response(false, $e->getMessage());
    }
  }
  public function update_password(string $password)
  {
    $sql = "UPDATE user SET password = :password WHERE user_id = :user_id";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':password', $password, PDO::PARAM_STR);
      $stmt->execute();
      return new Response(true, "Password updated successfully");
    } catch (PDOException $e) {
      return new Response(false, $e->getMessage());
    }
  }

  public function update_user(UserDTO $user)
  {
    $sql = "UPDATE user SET 
    first_name = :first_name, 
    last_name = :last_name, 
    email = :email, 
    password = :password, 
    role_id = :role_id, 
    team_id = :team_id
    WHERE user_id = :user_id";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':first_name', $user->first_name, PDO::PARAM_STR);
      $stmt->bindParam(':last_name', $user->last_name, PDO::PARAM_STR);
      $stmt->bindParam(":email", $user->email, PDO::PARAM_STR);
      $stmt->bindParam(":password", $user->password, PDO::PARAM_STR);
      $stmt->bindParam(":role_id", $user->role_id, PDO::PARAM_INT);
      $stmt->bindParam(":team_id", $user->team_id, PDO::PARAM_INT);

      $stmt->execute();
      return new Response(true, "User updated successfully");
    } catch (PDOException $e) {
      return new Response(false, $e->getMessage());
    }
  }
}
