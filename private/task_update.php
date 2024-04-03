<?php

/**
 * Task update page.
 */

declare(strict_types=1);
include_once("../service/task.php");
include_once("../utils/checkers.php");
include_once("../utils/convertors.php");
include_once("../partials/options.php");

session_start();

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
    $update_at = $task->get_updated_at();
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

  $task = new Task(intval($task_id), $task_name, $task_description, $user_email, $category, $status,  $team, $start_date, $due_date);

  $service = new TaskService();
  $resp = $service->update_task($task);
  if ($resp) {
    // header("Location: personal.php");
  }
}
?>
<?php include("../partials/header.php") ?>
<main class="d-flex justify-content-center align-items-center">
  <?php include("../partials/forms/task_form.php") ?>
</main>
  <button  class="btn btn-secondary btn-sm" ><a  class=" link-light" href="javascript:history.go(-1)"> < Go Back </a></button> 
<?php include("../partials/footer.php") ?>