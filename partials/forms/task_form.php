<?php

$task = $task_name = $task_description = $status = $category = "";
$team = $start_date = $due_date = $created_at = $update_at = "";

?>



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