<?php

/**
 * Task update page.
 */

declare(strict_types=1);
include_once("../service/task.php");
include_once("../utils/checkers.php");
include_once("../utils/convertors.php");
include_once("../partials/options.php");
include_once("../partials/back_btn.php");

session_start();
$user_email = $_SESSION['email'];
$task_id = 0;
$task = $task_name = $task_description = $status = $category = "";
$team = $start_date = $due_date = $created_at = $update_at = "";
/**
 * Task id is passed as a query parameter with GET method
 */
if (isset($_GET['task_id'])) {
  $service = new TaskService();

  $task_id = $_GET['task_id'];
  $task = $service->get_task_by_id(intval($task_id));

  if (isset($task)) {
    $task_name = $task->get_task_name();
    $task_description = $task->get_task_description();
    $status = $task->get_status();
    $category = $task->get_category();
    $team = $task->get_team();
    $start_date = $task->get_start_date();
    $due_date = $task->get_due_date();
    $created_at = $task->get_created_at();
    $updated_at = $task->get_updated_at();
  }

}


/**
 * handle update with POST
 */
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
  $task_id =  sanitize($_POST['task_id'], Input::number);
  $task_name = sanitize($_POST['task_name'], Input::string);
  $task_description = sanitize($_POST['task_description'], Input::string);
  $status = sanitize($_POST['status'], Input::string);
  $user_email = sanitize($_SESSION['email'], Input::email);
  $category = sanitize($_POST['category'], Input::string);
  $team = sanitize($_POST['team'], Input::string);
  $start_date = $_POST['start_date'];
  $due_date = $_POST['due_date'];
  $created_at = $_POST['created_at'];
  $updated_at= $_POST['updated_at'];

  $task = new Task(intval($task_id), $task_name, $task_description, $user_email, $category, $status,  $team, $start_date, $due_date, $created_at, $updated_at);
  echo "POST";
  pprint($_POST);
  $service = new TaskService();
  $resp = $service->update_task($task);
  if ($resp) {
    header("Location: personal.php");
  }
}
?>
<?php include("../partials/header.php") ?>
<main class="d-flex justify-content-center align-items-center">

<form class="create_task_form d-flex flex-column w-50  border rounded p-2 " action="task_update.php" method="POST">
  <input type="hidden" name="task_id" value="<?= $task_id ?>">
  <input type="hidden" name="user_email" value="<?= $user_email ?>">
  <label class="form-label" for="task_name"> Task Name
    <input class="form-control" name="task_name" id="task_name" type="text" value="<?php echo $task_name ?>">
  </label>

  <label class="form-label" for="task_description"> Task Description
    <input class="form-control" name="task_description" id="task_description" type="text" value="<?php echo  $task_description ?>">
  </label>
  <label class="form-label" for="status">Status
    <select name="status" id="status" class="form-select" aria-label="select task status" >
      <?php status_options($status) ?>
    </select>
  </label>
  <label class="form-label" for="category"> Category
    <select name="category" id="category" class="form-select" aria-label="select task team">
      <?php category_options($category) ?>
    </select>
  </label>
  <label class="form-label" for="team"> Team
    <select name="team" id="team" class="form-select" aria-label="select task team">
      <?php team_options($team) ?>
    </select>

  </label>
  <label class="form-label" for="start_date"> Start Date
    <input class="form-control" name="start_date" id="start_date" type="date" value="<?= string_to_date($start_date, 'Y-m-d')?>">
  </label>
  <label class="form-label" for="due_date"> Due Date
    <input class="form-control" name="due_date" id="due_date" type="date" value="<?= string_to_date($due_date, 'Y-m-d') ?>">
  </label>
  <?php if (isset($_GET['task_id'])) : ?>
    <input type="hidden" name="created_at" id="created_at" value="<?= $created_at ?>">
    <input type="hidden" name="updated_at" id="updated_at" value="<?= $update_at ?>">
    <?php if (string_to_date($update_at) !== "") : ?>
      <small>Last Update: <?= date("d/m/Y", strtotime($update_at)) ?> </small>
    <?php endif ?>
  <?php endif ?>
  <div class="d-flex gap-2">
    <button class="btn btn-danger my-2 w-50" type="reset"> Reset </button>
    <button id="submit" class="btn btn-primary my-2 w-50" type="submit">
      <?php if (isset($_GET['task_id'])) : ?>
        Update Task
      <?php else : ?>
        Create Task
      <?php endif ?>
    </button>

  </div>
</form>
</main>
        <?php echo back_btn(); ?>
  <!-- <button  class="btn btn-secondary btn-sm" ><a  class=" link-light" href=> < Go Back </a></button>  -->
<?php include("../partials/footer.php") ?>