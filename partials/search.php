<?php
declare(strict_types=1);
include("../service/task.php");
include("../config/pdo.php");

$pdo = new PdoDao();
$conn = $pdo->get_pdo();
$service = new TaskService($conn);
$tasks = $service->get_tasks();
$json = json_encode($tasks);

?>
<!-- <form class="d-flex" role="search">
  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success" type="submit">Search</button>
</form> -->
  
  <button><input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"></button>
<script>
  const json = <?= $json ?>
  
</script>