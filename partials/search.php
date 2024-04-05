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
include_once("../server/service/task.php");
include_once("../server/utils/convertors.php");

$service = new TaskService();
$tasks = $service->get_tasks();
$json= json_encode($tasks);
?>
<dialog id="search_dialog">
  <input type="text" id="search_input" class="form-control w-50">
  <div id="filtered_tasks"></div>
  <button class="btn btn-sm btn-danger mt-2" id="close_search_dialog"> Close</button>
</dialog>

<button class="btn btn-lg btn-secondary" id="show_search_dialog">Search </button>


<script src="../public/js/search.js" type="module"></script>