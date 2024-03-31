<?php
declare(strict_types=1);
include_once("../service/task.php");
include_once("../config/pdo.php");

$page_name = "Dashboard";

$service = new TaskService();
// $updateTask= new TaskDTO(1,"Update Task","Update Task Description",2,1,1,1,"2024-01-01","2024-03-01");
// $newTask= new Task(null,"Commit New Task","Commit new description", $_);
// $service->create_task($newTask);
// $service->delete_task(3);
$result =  $service->get_tasks();

?>


<?php include("../partials/header.php") ?>
<?= $page_name ?>

<?php include("../partials/footer.php") ?>