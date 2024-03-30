<?php
declare(strict_types=1);
include("../service/task.php");
include("../config/pdo.php");

$page_name = "Dashboard";

$pdo = new PdoDao();
$conn = $pdo->get_pdo();
$service = new TaskService($conn);
// $updateTask= new TaskDTO(1,"Update Task","Update Task Description",2,1,1,1,"2024-01-01","2024-03-01");
// $newTask= new Task(null,"Commit New Task","Commit new description", $_);
// $service->create_task($newTask);
// $service->delete_task(3);
$result =  $service->get_tasks();

?>


<?php include("../partials/header.php") ?>
<?= $page_name ?>

<?php include("../partials/footer.php") ?>