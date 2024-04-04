<?php

function team_tasks_list(Task $task)
{
 return `
<div class="card text-bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">$task=>get_task_name()</div>
  <div class="card-body">
    <h5 class="card-title"></h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
  `;
}
