<?php

declare(strict_types=1);
include("../service/task.php");
include("../config/pdo.php");
include("../utils/checkers.php");
include("../utils/convertors.php");

session_start();

$task_id = 0;

if (isset($_GET['task_id'])) {

  $task_id = $_GET['task_id'];
  $pdo = new PdoDao();
  $conn = $pdo->get_pdo();
  $service = new TaskService($conn);
  $task = $service->get_task_by_id(intval($task_id));

  $task_name = $task->get_task_name();
  $task_description = $task->get_task_description();
  $status = $task->get_status();
  $category = $task->get_category();
  $team = $task->get_team();
  $start_date = $task->get_start_date();
  $due_date = $task->get_due_date();
  $created_at = $task->get_created_at();
  $update_at = $task->get_updated_at();
}

$statuses = ["Working", "Completed", "Overdue"];
function status_options($statuses)
{
  foreach ($statuses as $status) {
    echo "<option value='$status'>$status</option>";
  }
}

/**
 * handle update with POST
 */
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
  // var_dump($_POST);
  $task_id =  sanitize($_POST['task_id'], Input::number);
  $task_name = sanitize($_POST['task_name'], Input::string);
  $task_description = sanitize($_POST['task_description'], Input::string);
  $status = sanitize($_POST['status'], Input::string);
  $user_email = sanitize($_SESSION['email'], Input::email);
  $category = sanitize($_POST['category'], Input::string);
  $team = sanitize($_POST['team'], Input::string);
  $start_date = $_POST['start_date'];
  $due_date = $_POST['due_date'];

  $task = new Task(intval($task_id), $task_name, $task_description, $user_email, $category, $status,  $team, $start_date, $due_date);

  $pdo = new PdoDao();
  $conn = $pdo->get_pdo();
  $service = new TaskService($conn);
  $resp = $service->update_task($task);
  if ($resp) {
    // header("Location: personal.php");
  }
}
?>
<?php include("../partials/header.php") ?>
<main class="d-flex justify-content-center align-items-center">
  <form class="d-flex flex-column w-50  border rounded p-2 " action="task_update.php" method="POST">
    <input type="hidden" name="task_id" value="<?= $task_id ?>">
    <label class="form-label" for="task_name"> Task Name</label>
    <input class="form-control" name="task_name" id="task_name" type="text" value="<?php echo $task_name ?>">
    <label class="form-label" for="task_description"> Task Description </label>
    <input class="form-control" name="task_description" id="task_description" type="text" value="<?php echo  $task_description ?>">
    <label class="form-label" for="status"> Status </label>
    <select name="status" id="status" class="form-select" aria-label="select task status">
      <?php status_options($statuses) ?>
    </select>
    <label class="form-label" for="category"> Category </label>
    <input class="form-control" name="category" id="category" type="text" value="<?= $category ?>">
    <label class="form-label" for="team"> Team </label>
    <input class="form-control" name="team" id="team" type="text" value="<?= $team ?>">
    <label class="form-label" for="start_date"> Start Date </label>

    <input class="form-control" name="start_date" id="start_date" type="date" value="<?= string_to_date($start_date) ?>">
    <label class="form-label" for="due_date"> Due Date </label>
    <input class="form-control" name="due_date" id="due_date" type="date" value="<?= string_to_date($due_date) ?>">

    <?php if (isset($_GET['task_id'])) : ?>
      <input type="hidden" name="created_at" value="<?= string_to_date($created_at) ?>">
      <input type="hidden" name="update_at" value="<?= string_to_date($update_at) ?>">
      <?php if (string_to_date($update_at) !== "") : ?>
        <small>Last Update: <?= date("d/m/Y", strtotime($update_at)) ?> </small>
      <?php endif ?>
    <?php endif ?>
    <div class="d-flex gap-2">
      <button class="btn btn-danger my-2 w-50" type="reset"> Reset </button>
      <button class="btn btn-primary my-2 w-50" type="submit"> Update Task </button>
    </div>
  </form>
</main>
<?php include("../partials/footer.php") ?>