<?php
/**
 * Search Modal form
 * when the user clicks on the search input
 * a modal form will pop up with a list of tasks
 * that the user can search through
 * 
 * This is will be a frontend search. 
 */
declare(strict_types=1);
include_once("../service/task.php");
include_once("../config/pdo.php");

$service = new TaskService();
$tasks = $service->get_tasks();
$json = json_encode($tasks);

?>
<!-- <form class="d-flex" role="search">
  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success" type="submit">Search</button>
</form> -->
  
  <button><input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"></button>
<script>
  const json = <?php echo $json ?>;
  console.log(json);
  /**
   * JavaScript dynamically generate HTML elements
   * to list the tasks in the search modal.
   */
</script>