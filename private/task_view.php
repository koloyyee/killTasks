<?php
// single task
declare(strict_types=1);
include_once("../service/task.php");
include_once("../utils/convertors.php");
include_once("../partials/back_btn.php");

if (isset($_GET["task_id"])) {
  $task_id = $_GET['task_id'];

  $service = new TaskService();
  $task = $service->get_task_by_id(intval($task_id));
  if (isset($task)) {
    $task_name = $task->get_task_name();
    $task_description = $task->get_task_description();
    $status = ucwords($task->get_status());
    $category = ucwords($task->get_category());
    $team = ucwords($task->get_team());
    $user_email= $task->get_user_email();
    $start_date = $task->get_start_date()  != "" ? string_to_date($task->get_start_date(), 'Y/m/d') : "";
    $due_date = $task->get_due_date()!= "" ?  string_to_date($task->get_due_date(), 'Y/m/d') : "";
    $created_at = string_to_date($task->get_created_at(), 'Y/m/d');
    $update_at = $task->get_updated_at() != ""  ? string_to_date($task->get_updated_at(), 'Y/m/d'): "" ;
  }
}
?>
<?php include("../partials/header.php") ?>
<main class="">
    <div class="card">
      <div class="card-header">
        <h2>Task: <?php echo $task_name ?></h2>
      </div>
      <div class="card-body">
        <p>Task Description: <?php echo $task_description ?></p>
        <p>Assignee: <?php echo $user_email?></p>
        <p>Status: <?php echo $status ?></p>
        <p>Category: <?php echo $category ?></p>
        <p>Team: <?php echo $team ?></p>
        <p>Start Date: <?php echo $start_date ?></p>
        <p>Due Date: <?php echo $due_date ?></p>
        <p>Created At: <?php echo $created_at ?></p>
        <p>Updated At: <?php echo $update_at ?></p>
      </div>
    </div>

</main>

<?php echo back_btn("../private/dashboard.php"); ?>
<?php include("../partials/footer.php") ?>