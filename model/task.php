<?php
class Task
{
  private int $task_id;
  private string $task_name;
  private string $task_description;
  private string $user_first_name;
  private string $user_last_name;
  private string | null $team_name;
  private string $status;
  private string | null $category;
  private string $created_at;
  private string $updated_at;
  private string $start_date;
  private string $due_date;

  function __construct(int $task_id, string $task_name, string $task_description, string $status, string | null $category, string $user_first_name, string $user_last_name, string | null $team_name, string $start_date, string $due_date, string $created_at, string $updated_at)
  {
    $this->task_id = $task_id;
    $this->task_name = $task_name;
    $this->task_description = $task_description;
    $this->status = $status;
    $this->category = $category;
    $this->user_first_name = $user_first_name;
    $this->user_last_name = $user_last_name;
    $this->team_name = $team_name;
    $this->start_date = $start_date;
    $this->due_date = $due_date;
    $this->created_at = $created_at;
    $this->updated_at = $updated_at;
  }

}

class TaskDTO {
  public ?int  $task_id;
  public string $task_name;
  public string $task_description;
  public int $status_id;
  public int $user_id;
  public int $team_id;
  public int $category_id;
  public string $start_date;
  public string $due_date;
  public function __construct(?int  $task_id, string $task_name, string $task_description, int $status_id, int $user_id, int $team_id, int $category_id, string $start_date, string $due_date)
  {
    $this->task_id = $task_id;
    $this->task_name = $task_name;
    $this->task_description = $task_description;
    $this->status_id = $status_id;
    $this->user_id = $user_id;
    $this->team_id = $team_id;
    $this->category_id = $category_id;
    $this->start_date = $start_date;
    $this->due_date = $due_date;
  }
}