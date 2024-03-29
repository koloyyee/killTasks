<?php

declare(strict_types=1);
include("../model/team.php");

// CRUD of team
class TeamService
{
  private PDO $conn;
  function __construct(PDO $conn)
  {
    $this->conn = $conn;
  }

  public function get_teams(): array
  {
    $teams = [];
    $sql = "SELECT * FROM team t ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
      $team = new Team($row['team_id'], $row['team_name'], $row['team_description']);
      array_push($teams, $team);
    }
    return $teams;
  }

  public function get_team_with_members(): array
  {
    $teams = [];
    $sql = "SELECT 
    t.team_id, t.team_name, t.team_description,
    u.user_id, u.first_name, u.last_name, u.email 
    FROM team t LEFT JOIN user u ON t.team_id = u.team_id
    GROUP by t.team_id, u.user_id;
    ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($result)) {
      foreach ($result as $row) {
        if (!isset($teams[$row['team_id']])) {
          $teams[$row['team_id']] = new Team($row['team_id'], $row['team_name'], $row['team_description']);
        }
        if ($row['user_id'] != null) {
          $teams[$row['team_id']]->set_members(new User($row['user_id'], $row['first_name'], $row['last_name'], $row['email']));
        }
      }
      return $teams;
    }
  }

  public function get_team_by_id(int $team_id): Team
  {
    $id = sanitize($team_id, Input::number);
    $sql = "SELECT * FROM team WHERE team_id = :team_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':team_id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $team = new Team($result['team_id'], $result['team_name'], $result['team_description']);
    return $team;
  }
}
