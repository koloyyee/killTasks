<?php

declare(strict_types=1);
// show all tasks
include("../service/task.php");
include("../config/pdo.php");

$pdo = new PdoDao();
$conn = $pdo->get_pdo();
$task_service = new TaskService($conn);
$tasks =  $task_service->get_tasks();
$groupByStatus = array();
foreach ($tasks as $key => $value) {
  $groupByStatus[$value->get_status()][] = $value;
}

$json = json_encode($groupByStatus);

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
  if (isset($_GET['task_id']) && isset($_GET['method'])) {
    $task_id = $_GET['task_id'];
    $method = $_GET['method'];
    if ($method === "completed") {
      $task_service->update_status(intval($task_id), "completed");
      header("Location: ./personal.php");
    } else if ($method === "delete") {
      $task_service->delete_task(intval($task_id));
      header("Location: ./personal.php");
    }
  }
}

?>
<?php foreach ($groupByStatus as $status => $tasks) : ?>
  <table class="tasks_table">
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
        <?php if ($status !== "completed") : ?>
          <th>Mark as Completed</th>
          <th>Update</th>
          <th>Delete</th>
        <?php endif ?>
      </tr>
    </thead>
    <tbody>
      <h3> <?php echo $status ?> </h3>
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
          <?php if ($status !== "completed") : ?>
            <td> <a href=<?= "../private/personal.php?task_id=" . $task->get_task_id() . "&method=completed"; ?>>Completed </a></td>
            <td> <a href="../private/task_update.php"> Update Task </a></td>
            <td> <a href=<?= "../private/personal.php?task_id=" . $task->get_task_id() . "&method=delete"; ?>>Delete Task</a></td>
          <?php endif ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endforeach; ?>
<script>
  const tasks = JSON.parse(`<?php echo $groupByStatus ?>`);
  // create the table
</script>