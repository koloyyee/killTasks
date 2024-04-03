<?php

declare(strict_types=1);
include_once("../service/task.php");
include_once("../utils/checkers.php");
include_once("../utils/convertors.php");
include_once("../partials/options.php");

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$user_email = $_SESSION['email'];
$task_id = 0;
$task = $task_name = $task_description = $status = $category = "";
$team = $start_date = $due_date = $created_at = $update_at = "";

if (isset($_GET['task_id'])) {
  $task_id = $_GET['task_id'];
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $task_id =  $_POST['task_id'] === null ? null : sanitize($_POST['task_id'], Input::number);
  $task_name = sanitize($_POST['task_name'], Input::string);
  $task_description = sanitize($_POST['task_description'], Input::string);
  $user_email = sanitize($_POST['user_email'], Input::string);
  $status = sanitize($_POST['status'], Input::string);
  $category = sanitize($_POST['category'], Input::string);
  $team = sanitize($_POST['team'], Input::string);
  $start_date = string_to_date($_POST['start_date'], "Y-m-d");
  $due_date = string_to_date($_POST['due_date'], "Y-m-d");

  $task = new Task($task_id , $task_name, $task_description, $user_email, $category, $status,  $team, $start_date, $due_date);
  $service = new TaskService();
  
  if($task_id == null) {
    $resp = $service->create_task($task);
  } else {
    $resp = $service->update_task($task);
  }
  if ($resp->success) {
      unset($_POST);
      header("Location: ../private/personal.php");
  }
}

?>
<form class="create_task_form d-flex flex-column w-50  border rounded p-2 " action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
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
  <div class="form-group">
  <label class="form-label" for="team"> Team
    <select name="team" id="team" class="form-select" aria-label="select task team">
      <?php team_options($team) ?>
    </select>
  </label>

  </div>
  <label class="form-label" for="start_date"> Start Date
    <input class="form-control" name="start_date" id="start_date" type="date" value="<?= string_to_date($start_date, 'Y-m-d') ?>">
  </label>
  <label class="form-label" for="due_date"> Due Date
    <input class="form-control" name="due_date" id="due_date" type="date" value="<?= string_to_date($due_date, 'Y-m-d') ?>">
  </label>




  <?php if (isset($_GET['task_id'])) : ?>
    <input type="hidden" name="created_at" value="<?= string_to_date($created_at, 'Y-m-d') ?>">
    <input type="hidden" name="update_at" value="<?= string_to_date($update_at, 'Y-m-d') ?>">
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

<script>
  const currPath = window.location.pathname;

  const phpPath = "<?= $_SERVER['REQUEST_URI'] ?>";


  console.log({
    currPath,
    phpPath
  });

  // const form = document.querySelector(".create_task_form");
  // form.addEventListener("submit", (event) => {
  //   event.preventDefault();
  //   const formData = new FormData(form);
  //   for (const [key, value] of formData.entries()) {
  //     console.log(key, value);
  //   }

  //   fetch(".", {
  //     method: "POST",
  //     body: formData,
  //   }).then((response) => {
  //     console.log(response);
  //   }).catch((error) => {
  //     console.log(error);
  //   });


  //   form.reset();
  //   dialog.close();
  // });
</script>