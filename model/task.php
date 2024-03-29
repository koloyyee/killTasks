<?php
class Task
{
  private int $task_id;
  private string $task_name;
  private string $task_description;
  private string $task_status;
  private string $task_category;
  private string $task_created_at;
  private string $task_updated_at;
  private string  $task_start_date;
  private string $task_due_date;

  function __construct(int $task_id, string $task_name, string $task_description, string $task_status, string $task_category, string $task_created_at, string $task_updated_at, string $task_start_date, string  $task_due_date)
  {
    $this->task_id = $task_id;
    $this->task_name = $task_name;
    $this->task_description = $task_description;
    $this->task_status = $task_status;
    $this->task_category = $task_category;
    $this->task_created_at = $task_created_at;
    $this->task_updated_at = $task_updated_at;
    $this->task_start_date = $task_start_date;
    $this->task_due_date = $task_due_date;
  }

  public function get_task_id(): int
  {
    return $this->task_id;
  }
  public function get_task_name(): string
  {
    return $this->task_name;
  }
  public function get_task_description(): string
  {
    return $this->task_description;
  }
  public function get_task_status(): string
  {
    return $this->task_status;
  }
  public function get_task_category(): string
  {
    return $this->task_category;
  }
  public function get_task_created_at(): string
  {
    return $this->task_created_at;
  }
  public function get_task_updated_at(): string
  {
    return $this->task_updated_at;
  }
  public function get_task_start_date(): string
  {
    return $this->task_start_date;
  }
  public function get_task_due_date():string  
  {
    return $this->task_due_date;
  }
}
