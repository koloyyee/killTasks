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
// $updateTask= new TaskDTO(1,"Update Task","Update Task Description",2,1,1,1,"2024-01-01","2024-03-01");
// $newTask= new TaskDTO(null,"New Task","New Task Description",2,2,2,2,"2024-05-01","2024-05-05");
// $service->create_task($newTask);
$result = $service->get_task_by_id(2);
echo "<pre>";
var_dump($result);
echo "</pre>";

?>

<?php include("../partials/header.php") ?>
<?= $page_name ?>

<?php include("../partials/footer.php") ?>