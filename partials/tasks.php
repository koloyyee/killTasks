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
        <h3> <?php echo $status ?> </h3>
        <?php foreach ($tasks as $task) : ?>
          <tr>
            <td><?php echo $task->get_task_name() ?></td>
            <td><?php echo $task->get_task_description() ?></td>
            <td><?php echo $task->get_user_email() ?></td>
            <td><span class="<?php echo "badge text-bg-" . status_color($task->get_status()); ?>"><?php echo $task->get_status() ?></span></td>
            <td><?php echo $task->get_category()  ?? "" ?></td>
            <td><?php echo $task->get_team() ?? "" ?></td>
            <td><?php echo $task->get_start_date() ?? "" ?></td>
            <td><?php echo $task->get_due_date() ?? "" ?></td>
            <?php if ($status !== "completed") : ?>
              <td> <a href=<?= "../private/personal.php?task_id=" . $task->get_task_id() . "&method=completed"; ?>>Completed </a></td>
              <td> <a href=<?= "../private/task_update.php?task_id=" . $task->get_task_id(); ?> > Update Task </a></td>
              <td> <a href=<?= "../private/personal.php?task_id=" . $task->get_task_id() . "&method=delete"; ?>>Delete Task</a></td>
            <?php endif ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endforeach; ?>
</main>
<script>
  // const tasks = JSON.parse(`<?php echo $groupByStatus ?>`);
  // create the table
  console.log(<?php echo $status?>)
</script>
