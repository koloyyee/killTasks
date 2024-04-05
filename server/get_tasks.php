<?php
include(__DIR__ . "/service/task.php");

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
// echo __FILE__;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $taskService = new TaskService();
  if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    $task = $taskService->get_task_by_id($task_id);
    echo json_encode($task);
    exit;
  } else {
    $tasks = $taskService->get_tasks();
    echo json_encode($tasks);
    exit;
  }
}
