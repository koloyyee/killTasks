<?php

declare(strict_types=1);
include("../service/task.php");
include("../config/pdo.php");


if (isset($_GET['task_id'])) {
  $task_id = $_GET['task_id'];
  $pdo = new PdoDao();
  $conn = $pdo->get_pdo();
  $service = new TaskService($conn);
  $task = $service->get_task_by_id(intval($task_id));

  var_dump($task);

  $task_name = $task->get_task_name();
  $task_description = $task->get_task_description();
  $status = $task->get_status();
  $category = $task->get_category();
  $team = $task->get_team();
  $start_date = $task->get_start_date();
  $due_date = $task->get_due_date();
}

$statuses = ["Working", "Completed", "Overdue"];
function status_options($statuses)
{
  foreach ($statuses as $status) {
    echo "<option value='$status'>$status</option>";
  }
}

function strtodate($date)
{
  return date("c", strtotime($date));
}

/**
 * handle update with POST
 */

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
  $task_id = $_GET['task_id'];
  $task_name = $_POST['task_name'];
  $task_description = $_POST['task_description'];
  $status = $_POST['status'];
  $user_email = $_SESSION['email'];
  $category = $_POST['category'];
  $team = $_POST['team'];
  $start_date = $_POST['start_date'];
  $due_date = $_POST['due_date'];

  $task = new Task($task_id,$task_name, $task_description, $user_email, $category, $status,  $team, $start_date, $due_date);

  $pdo = new PdoDao();
  $conn = $pdo->get_pdo();
  $service = new TaskService($conn);
  var_dump($task);
  // $service->update_task($task);

  // header("Location: /private/index.php");
} 
?>
<?php include("../partials/header.php") ?>
<form class="d-flex flex-column w-50" action="task_update.php" method="POST">
  <label class="form-label" for="task_name"> Task Name</label>
  <input class="form-control"  name="task_name" id="task_name" type="text" value="<?php echo $task_name ?>">
  <label class="form-label" for="task_description"> Task Description </label>
  <input class="form-control"  name="task_description" id="task_description" type="text" value="<?php echo  $task_description ?>">
  <label class="form-label" for="status"> Status </label>
  <select name="status" id="status" class="form-select" aria-label="select task status" >
    <?php status_options($statuses) ?>
  </select>
  <label class="form-label" for="category"> Category </label>
  <input class="form-control"  name="category" id="category" type="text" value="<?= $category ?>">
  <label class="form-label" for="team"> Team </label>
  <input class="form-control"  name="team" id="team" type="text" value="<?= $team ?>">
  <label class="form-label" for="start_date"> Start Date </label>
  
  <input class="form-control"  name="start_date" id="start_date" type="date" value="<?= $start_date ?  date('c', strtotime($start_date)) : "" ?>">
  <label class="form-label" for="due_date"> Due Date </label>
  <input class="form-control"  name="due_date" id="due_date" type="date" value="<?= $due_date?  date('c', strtotime($due_date)) : "" ?>">
  <button class="btn btn-primary my-2 w-50"  type="submit"> Update Task </button>
</form>
<?php include("../partials/footer.php") ?>