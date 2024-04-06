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
  
  const tasks = await fetch("/killtasks/server/get_tasks.php", {
    method: "GET",
  }).then(resp => {
    return resp.json()
  } )
  .then(data => data)
  .catch(err => console.error(err));

  const searchInput = document.querySelector("#search_input");
  const filteredTasks = document.querySelector("#filtered_tasks");

  searchInput.addEventListener("keyup", (event) => {
    const value = event.target.value;
    if (value === "") {
      filteredTasks.innerHTML = "";
      return;
    }
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
<a class="text-decoration-none" href="../private/task_view.php?task_id=${task.task_id}">
<div class="card" style="width: 18rem; margin-bottom: 1rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">
    ${task.task_name} by ${task.user_email} 
     <span class="bdg bdg-${statusColor(task.status)}"> ${task.status }</span>
    </li>
  </ul>
</div> 
</a>
`;
      filteredTasks.appendChild(div);
    });
  })
  function statusColor(status) {
    switch (status) {
      case "working":
        return "warning";
      case "completed":
        return "success";
      case "overdue":
        return "danger";
      default:
        return "warning";
    }
  }