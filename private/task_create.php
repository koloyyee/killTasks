<?php
/**
 * Task creation page.
 */
declare(strict_types=1);
include_once("../partials/status_options.php");
include_once("../service/task.php");
include_once("../utils/checkers.php");

if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'){
  $task_name = sanitize($_POST['task_name'], Input::string);
  $task_description = sanitize($_POST['task_description'], Input::string);
  $status = sanitize($_POST['status'], Input::string);
  $category = sanitize($_POST['category'], Input::string);
  $team = sanitize($_POST['team'], Input::string);
  $start_date = $_POST['start_date'];
  $due_date = $_POST['due_date'];
  $user_email = sanitize($_SESSION['email'], Input::email);

  $task = new Task(null, $task_name, $task_description, $user_email, $category, $status, $team, $start_date, $due_date);
  $service = new TaskService();
  $resp = $service->create_task($task);
  if ($resp) {
    header("Location: personal.php");
  }
}

?>


<?php include( "../partials/header.php") ?>
  <form action="task_create.php" method="POST" class="create_task_form" >
    <label for="task_name">Task Name</label>
    <input type="text" name="task_name" id="task_name">
    <label for="task_description">Task Description</label>
    <input type="text" name="task_description" id="task_description">
    <select name="status" id="status" >
      <?php status_options($statuses) ?>
    </select>
    <label for="category">Category</label>
    <input type="text" name="category" id="category">
    <label for="team">Team</label>
    <input type="text" name="team" id="team">
    <label for="start_date">Start Date</label>
    <input type="date" name="start_date" id="start_date">
    <label for="due_date">Due Date</label>
    <input type="date" name="due_date" id="due_date">
    <button type="submit">Create Task</button>
  </form>
<?php include(  "../partials/footer.php") ?>