<?php

declare(strict_types=1);
include("../model/task.php");

class TaskService
{
  private PDO $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }
  public function get_tasks()
  {
    $sql = "
      SELECT 
      t.task_name, t.task_description,
      s.status_name, 
      u.first_name, u.last_name,
      c.category_name,
      tm.team_name,
      t.start_date, t.due_date,
      t.created_at, t.updated_at

      FROM task t
      JOIN status s ON 
      s.status_id = t.status_id
      JOIN user u ON
      u.user_id = t.user_id
      JOIN team tm ON
      tm.team_id = t.team_id
      JOIN category c ON
      c.category_id = t.category_id;
    ";
    $statement = $this->pdo->prepare($sql);
    $statement->execute();
    $result =  $statement->fetchAll(PDO::FETCH_ASSOC);

    $tasks = [];
    if (!empty($result)) {
      foreach ($result as $row) {
        $task = new Task(
          $row['task_id'],
          $row['task_name'],
          $row['task_description'],
          $row['status_name'],
          $row['first_name'],
          $row['last_name'],
          $row['category_name'],
          $row['team_name'],
          $row['start_date'],
          $row['due_date'],
          $row['created_at'],
          $row['updated_at']
        );
        array_push($tasks, $task);
      }
      return $tasks;
    }
  }
  public function get_task_by_id(int $task_id): Task
  {
    $sql = "
      SELECT 
      t.task_id, t.task_name, t.task_description,
      s.status_name, 
      u.first_name, u.last_name,
      c.category_name,
      tm.team_name,
      t.start_date, t.due_date,
      t.created_at, t.updated_at

      FROM task t
      JOIN status s ON 
      s.status_id = t.status_id
      JOIN user u ON
      u.user_id = t.user_id
      JOIN team tm ON
      tm.team_id = t.team_id
      JOIN category c ON
      c.category_id = t.category_id;

      WHERE t.task_id = :task_id;
    ";
    try {

      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
      $stmt->execute();
      $result =  $stmt->fetch(PDO::FETCH_ASSOC);
      if (!empty($result)) {
        if ($result['start_date'] == null) {
          $result['start_date'] = "";
        }
        if ($result['due_date'] == null) {
          $result['due_date'] = "";
        }
        if ($result['updated_at'] == null) {
          $result['updated_at'] = "";
        }

        return new Task(
          $result['task_id'],
          $result['task_name'],
          $result['task_description'],
          $result['status_name'],
          $result['first_name'],
          $result['last_name'],
          $result['category_name'],
          $result['team_name'],
          $result['start_date'],
          $result['due_date'],
          $result['created_at'],
          $result['updated_at']
        );
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function update_task(int $task_id, int $status_id)
  {
    try {

      $sql = "UPDATE task SET status_id = :status_id WHERE task_id = :task_id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(':status_id', $status_id, PDO::PARAM_INT);
      $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}
