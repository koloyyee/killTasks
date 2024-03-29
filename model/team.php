<?php
declare(strict_types=1);
include("user.php");

class Team {
  private int $team_id;
  private string $team_name;
  private string $team_description;
  private array $members;

  function __construct(int $team_id, string $team_name, string $team_description)
  {
    $this->team_id = $team_id;
    $this->team_name = $team_name;
    $this->team_description = $team_description;
    $this->members = [];
  }
  public function get_team_id():int {
    return $this->team_id;
  }
  public function get_team_name():string {
    return $this->team_name;
  }
  public function get_team_description():string {
    return $this->team_description;
  }
  public function set_members(User $member):void {
    array_push($this->members, $member);
  }
  public function get_members():array {
    return $this->members;
  }
  
}