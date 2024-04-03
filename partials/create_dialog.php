<?php
include_once("../utils/convertors.php");
include_once("../partials/status_options.php");

$task = $task_name = $task_description = $status = $category = "";
$team = $start_date = $due_date = $created_at = $update_at = "" ;
?>


<dialog id="create_task_dialog" >
  <?php include("../partials/forms/task_form.php") ?>
  <button id="close_dialog_btn">Close</button>
</dialog>

<button id="show_dialog_btn"> + </button>



<script type="module" src="../public/js/dialog.js"></script>