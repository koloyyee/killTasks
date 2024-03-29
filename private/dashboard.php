<?php
declare(strict_types=1);
include("../service/task.php");
include("../service/status.php");
include("../service/category.php");
include("../service/team.php");
include("../config/pdo.php");

$page_name = "Dashboard";

$pdo = new PdoDao();
$conn = $pdo->get_pdo();
$service = new TaskService($conn);
  $service->update_task(1, 2);
$result = $service->get_task_by_id(1);
echo "<pre>";
var_dump($result);
echo "</pre>";

?>

<?php include("../partials/header.php") ?>
<?= $page_name ?>

<?php include("../partials/footer.php") ?>