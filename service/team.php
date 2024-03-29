<?php

// CRUD of team
  class TeamService {
    private PDO $conn;
    function __construct(PDO $conn)
    {
      $this->conn = $conn;
    }

    public function get_teams(): array {
      $teams = [];
      $sql = "SELECT 
              t.team_id, t.team_name, t.team_description, u.user_name as member
              FROM team t 
              join team_user tu 
              on t.team_id = tu.team_id
              join user u
              on tu.user_id = u.user_id
              ";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row) {
        $team = new Team($row['team_id'], $row['team_name'], $row['team_description']);
        array_push($teams, $team);
      }
      return $teams;
    }
    public function get_team_by_id(int $team_id): Team {
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
?>