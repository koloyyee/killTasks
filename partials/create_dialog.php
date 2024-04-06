<?php
include_once("../server/utils/convertors.php");

$task = $task_name = $task_description = $status = $category = "";
$team = $start_date = $due_date = $created_at = $update_at = "";
?>


<dialog id="create_task_dialog">
  <?php include("../partials/forms/task_form.php") ?>
  <button class="btn btn-secondary" id="close_dialog_btn">Close</button>
</dialog>
<div >
  <button class="btn btn-primary m-2" id="show_dialog_btn"> + New Task </button>
</div>
<script type="module" src="../public/js/dialog.js"></script>