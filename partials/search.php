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
$json = json_encode($tasks);
?>
<dialog id="search_dialog">
  <input type="text" id="search_input" class="form-control">
  <div id="filtered_tasks"></div>
  <button class="btn btn-lg btn-danger" id="close_search_dialog"> Close</button>
</dialog>

<button class="btn btn-lg btn-secondary" id="show_search_dialog">Search </button>
<script>
  /** Dialog control */
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

  /** Show and render all tasks */
  const tasks = <?php echo $json; ?>;
  console.log(tasks);

  const searchInput = document.querySelector("#search_input");
  const filteredTasks = document.querySelector("#filtered_tasks");

  searchInput.addEventListener("keyup", (event) => {
    const value = event.target.value;
    const filtered = tasks.filter((task) => {
      return task.task_name.toLowerCase().includes(value.toLowerCase()) ||
        task.task_description.toLowerCase().includes(value.toLowerCase()) ||
        task.status.toLowerCase().includes(value.toLowerCase()) ||
        task.team?.toLowerCase().includes(value.toLowerCase()) ||
        task.category.toLowerCase().includes(value.toLowerCase()) ||
        task.user_email.toLowerCase().includes(value.toLowerCase());
    });
    filteredTasks.innerHTML = "";

    filtered.forEach((task) => {
      const div = document.createElement("div");
      div.innerHTML = `
<a href="../private/task_view.php?task_id=${task.task_id}">
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">${task.task_name}</li>
    <li class="list-group-item">${task.user_email}</li>
  </ul>
</div> 
</a>
`;
      filteredTasks.appendChild(div);
    });
  })
</script>