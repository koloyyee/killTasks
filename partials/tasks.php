<?php

declare(strict_types=1);
// show all tasks
include_once("../server/service/task.php");
include_once("../server/config/pdo.php");
include_once("../server/utils/convertors.php");
include_once("../partials/badges.php");
include_once("../partials/back_btn.php");


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


?>
<main class="table-responsive table_wrapper">
  <?php foreach ($groupByStatus as $status => $tasks) : ?>
    <table class="table table-bordered align-middle">
      <thead>
        <tr>
          <th scope="col">Task Name</th>
          <th scope="col">Status</th>
          <th scope="col">Category</th>
          <th scope="col">Team</th>
          <th scope="col">Start Date</th>
          <th scope="col">Due Date</th>
          <th scope="col"> Detail </th>
          <?php if ($status !== "completed") : ?>
            <th scope="col"> Completed</th>
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
            <td><?= status_badge($task->get_status()) ?> </td>
            <td><?php echo ucwords($task->get_category())  ?? "" ?></td>
            <td><?php echo ucwords($task->get_team()) ?? "" ?></td>
            <td><?php echo string_to_date($task->get_start_date(), 'Y/m/d') ?? "" ?></td>
            <td><?php echo string_to_date($task->get_due_date(), "Y/m/d") ?? "" ?></td>
            <td> <a class="text-decoration-none" href=<?= "../private/task_view.php?task_id=" . $task->get_task_id() ; ?>> 👁️</a></td>
            <?php if ($status !== "completed") : ?>
              <td> <a class="text-decoration-none" href=<?= "../private/personal.php?task_id=" . $task->get_task_id() . "&method=completed"; ?>> ✅</a></td>
              <td> <a class="text-decoration-none" href=<?= "../private/task_update.php?task_id=" . $task->get_task_id(); ?>> 📝 </a></td>
              <td> <a class="text-decoration-none" href=<?= "../private/personal.php?task_id=" . $task->get_task_id() . "&method=delete"; ?>>❌</a></td>
            <?php endif ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endforeach; ?>
</main>