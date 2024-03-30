<?php
$statuses = ["Working", "Completed", "Overdue"];
function status_options($statuses)
{
  foreach ($statuses as $status) {
    echo "<option value='$status'>$status</option>";
  }
}

?>


<?php include( "../partials/header.php") ?>
  <form action="create.php" method="POST" class="create_task_form" >
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