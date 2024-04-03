<?php

declare(strict_types=1);
// show all tasks
include_once("../service/task.php");
include_once("../config/pdo.php");
include_once("../utils/convertors.php");


$task_service = new TaskService();
$tasks =  $task_service->get_tasks_by_user($_SESSION['email']);
/**
 * Group tasks by status
 */
$groupByStatus = array();
if (isset($task) || empty($tasks)) {
  echo "<h1> No tasks found </h1>";
  return;
} else {
  foreach ($tasks as $key => $value) {
    $groupByStatus[$value->get_status()][] = $value;
    $json = json_encode($groupByStatus);
  }
}

/**
 * handle update with $_GET variables
 */
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
  if (isset($_GET['task_id']) && isset($_GET['method'])) {
    $task_id = $_GET['task_id'];
    $method = $_GET['method'];
    if ($method === "completed") {
      $task_service->update_status(intval($task_id), "completed");
    } else if ($method === "delete") {
      $task_service->delete_task(intval($task_id));
    }
    header("Location: personal.php");
  }

}

/**
 * @param string $status
 * @return string - bootstrap color class
 */
function status_color(string $status): string
{
  switch (strtolower($status)) {
    case "working":
      return "warning";
    case "completed":
      return "success";
    case "overdue":
      return "danger";
    default:
      return "warning";
  }
}

?>
<main class="mx-5">
  <?php foreach ($groupByStatus as $status => $tasks) : ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Task Name</th>
          <th scope="col">Task Description</th>
          <th scope="col">Assignee</th>
          <th scope="col">Status</th>
          <th scope="col">Category</th>
          <th scope="col">Team</th>
          <th scope="col">Start Date</th>
          <th scope="col">Due Date</th>
          <?php if ($status !== "completed") : ?>
            <th scope="col">Mark as Completed</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
          <?php endif ?>
        </tr>
      </thead>
      <tbody>
        <h3> <?= ucwords($status) ?> </h3>
        <?php foreach ($tasks as $task) : ?>
          <tr>
            <td><?php echo $task->get_task_name() ?></td>
            <td><?php echo $task->get_task_description() ?></td>
            <td><?php echo $task->get_user_email() ?></td>
            <td><span class="<?php echo "badge text-bg-" . status_color($task->get_status()); ?>"><?php echo ucwords($task->get_status()); ?></span></td>
            <td><?php echo ucwords($task->get_category())  ?? "" ?></td>
            <td><?php echo ucwords($task->get_team()) ?? "" ?></td>
            <td><?php echo string_to_date($task->get_start_date(), 'Y/m/d') ?? "" ?></td>
            <td><?php echo string_to_date($task->get_due_date(), "Y/m/d") ?? "" ?></td>
            <?php if ($status !== "completed") : ?>
              <td> <a href=<?= "../private/personal.php?task_id=" . $task->get_task_id() . "&method=completed"; ?>>Completed </a></td>
              <td> <a href=<?= "../private/task_update.php?task_id=" . $task->get_task_id(); ?>> Update Task </a></td>
              <td> <a href=<?= "../private/personal.php?task_id=" . $task->get_task_id() . "&method=delete"; ?>>Delete Task</a></td>
            <?php endif ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endforeach; ?>
</main>