<?php
$statuses = ["Working", "Completed", "Overdue"];
function status_options($statuses)
{
  foreach ($statuses as $status) {
    echo "<option value='$status'>$status</option>";
  }
}

?>


<?php include("../../partials/header.php") ?>
  <form action="create.php" method="POST">
    <label for="task_name">Task Name</label>
    <input type="text" name="task_name" id="task_name">
    <label for="task_description">Task Description</label>
    <input type="text" name="task_description" id="task_description">
    <label for="status">Task Status</label>
    <?= "<select name='status' id='status'>" . status_options($statuses) . "</select>" ?>

    <button type="submit">Create Task</button>

  </form>
<?php include("../../partials/footer.php") ?>