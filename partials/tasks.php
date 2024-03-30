<?php

declare(strict_types=1);
// show all tasks
include("../service/task.php");
include("../config/pdo.php");

$pdo = new PdoDao();
$conn = $pdo->get_pdo();
$task_service = new TaskService($conn);
$tasks =  $task_service->get_tasks();

// var_dump($_GET['task_id']);

?>
<table class="tasks_table" >
  <thead>
    <tr>
      <th>Task Name</th>
      <th>Task Description</th>
      <th>User</th>
      <th>Status</th>
      <th>Category</th>
      <th>Team</th>
      <th>Start Date</th>
      <th>Due Date</th>
      <th>Mark as Completed</th>
      <th>Update</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tasks as $task) : ?>
      <tr>
        <td><?php echo $task->get_task_name() ?></td>
        <td><?php echo $task->get_task_description() ?></td>
        <td><?php echo $task->get_user_email() ?></td>
        <td><?php echo $task->get_status() ?></td>
        <td><?php echo $task->get_category()  ?? "" ?></td>
        <td><?php echo $task->get_team() ?? "" ?></td>
        <td><?php echo $task->get_start_date() ?? "" ?></td>
        <td><?php echo $task->get_due_date() ?? "" ?></td>
        <td> <a href=<?= "../partials/tasks.php?task_id=" . $task->get_task_id() ?> >Completed </a></td>
        <td> <a href="../private/task_update.php" > Update Task </a></td>
        <td> <button>Delete Task</button></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

