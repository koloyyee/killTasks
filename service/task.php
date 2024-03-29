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
    try {

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
            $row['category_name'],
            $row['first_name'],
            $row['last_name'],
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
    } catch (PDOException $e) {
      echo $e->getMessage();
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
      c.category_id = t.category_id

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
          $result['category_name'],
          $result['first_name'],
          $result['last_name'],
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

  function create_task(TaskDTO $task)
  {
    try {
      $sql = "
      INSERT INTO task (
        task_name,
        task_description,
        status_id,
        user_id,
        team_id,
        category_id,
        start_date,
        due_date
      ) VALUES (
        :task_name,
        :task_description,
        :status_id,
        :user_id,
        :team_id,
        :category_id,
        :start_date,
        :due_date
      );
      ";

      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(':status_id', $task->status_id, PDO::PARAM_INT);
      $stmt->bindParam(':task_name', $task->task_name, PDO::PARAM_STR);
      $stmt->bindParam(':task_description', $task->task_description, PDO::PARAM_STR);
      $stmt->bindParam(':user_id', $task->user_id, PDO::PARAM_INT);
      $stmt->bindParam(':team_id', $task->team_id, PDO::PARAM_INT);
      $stmt->bindParam(':category_id', $task->category_id, PDO::PARAM_INT);
      $stmt->bindParam(':start_date', $task->start_date, PDO::PARAM_STR);
      $stmt->bindParam(':due_date', $task->due_date, PDO::PARAM_STR);

      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function update_task(TaskDTO $task)
  {
    try {
      $sql = "
      UPDATE task SET
      task_name = :task_name,
      task_description = :task_description,
      status_id = :status_id,
      user_id = :user_id,
      team_id = :team_id,
      category_id = :category_id,
      start_date = :start_date,
      due_date = :due_date
      WHERE task_id = :task_id;
      ";

      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(':status_id', $task->status_id, PDO::PARAM_INT);
      $stmt->bindParam(':task_id', $task->task_id, PDO::PARAM_INT);
      $stmt->bindParam(':task_name', $task->task_name, PDO::PARAM_STR);
      $stmt->bindParam(':task_description', $task->task_description, PDO::PARAM_STR);
      $stmt->bindParam(':user_id', $task->user_id, PDO::PARAM_INT);
      $stmt->bindParam(':team_id', $task->team_id, PDO::PARAM_INT);
      $stmt->bindParam(':category_id', $task->category_id, PDO::PARAM_INT);
      $stmt->bindParam(':start_date', $task->start_date, PDO::PARAM_STR);
      $stmt->bindParam(':due_date', $task->due_date, PDO::PARAM_STR);

      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}
