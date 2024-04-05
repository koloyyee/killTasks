<?php
include(__DIR__ . "/service/task.php");

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
// echo __FILE__;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $taskService = new TaskService();
  if (isset($_GET['team'])) {
    $task_id = $_GET['team'];
    exit;
  } else {
    $tasks = $taskService->get_tasks_by_team();
    echo json_encode($tasks);
    exit;
  }
}
