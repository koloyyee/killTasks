<?php
// single task
declare(strict_types=1);
include("../service/task.php");
include("../config/pdo.php");
include("../utils/convertors.php");

if (isset($_GET["task_id"])) {
  $task = $_GET['task_id'];

  $pdo = new PdoDao();
  $conn = $pdo->get_pdo();
  $service = new TaskService($conn);

  $task = $service->get_task_by_id(intval($task));
  $task_name = $task->get_task_name();
  $task_description = $task->get_task_description();
  $status = ucwords($task->get_status());
  $category = ucwords($task->get_category());
  $team = ucwords($task->get_team());
  $start_date = $task->get_start_date();
  $due_date = $task->get_due_date();
  $created_at = string_to_date($task->get_created_at());
  $update_at = string_to_date($task->get_updated_at());
}
?>
<?php include("../partials/header.php") ?>
<main class="">

  <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="popover" data-bs-title="Popover title" data-bs-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>

</main>

<?php include("../partials/footer.php") ?>