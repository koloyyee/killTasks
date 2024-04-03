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
include_once("../utils/convertors.php");

$service = new TaskService();
$tasks = $service->get_tasks();
?>
<dialog id="search_dialog">
  <input type="text" id="search_input" class="form-control">
  <button class="btn btn-lg btn-danger" id="close_search_dialog"> Close</button>
</dialog>

<button class="btn btn-lg btn-secondary" id="show_search_dialog">Search </button>
<script>
  /**
   * JavaScript dynamically generate HTML elements
   * to list the tasks in the search modal.
   */
  const dialog = document.querySelector("#search_dialog");
  const showButton = document.querySelector("#show_search_dialog");
  const closeButton = document.querySelector("#close_search_dialog");
  // "Show the dialog" button opens the dialog modally
  showButton.addEventListener("click", () => {
    dialog.showModal();
  });

  // "Close" button closes the dialog
  closeButton.addEventListener("click", () => {
    dialog.close();
  });
</script>