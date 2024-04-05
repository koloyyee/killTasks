"use strict";
import { fetchData, HTTP, Methods } from "../js/utils.js";

function statusColor(status) {
  switch(status) {
    case "working":
        return "warning";
    case "completed":
        return "success";
    default:
        return "danger";
  }
}



document.addEventListener("DOMContentLoaded", async () => {

  const teamTasks = document.querySelector("#teams_tasks");
/**
 * Fetch task by teams.
 */
let tasks = await fetchData("get_teams_tasks.php", Methods.GET);
let teams = new Set(tasks.map((task) => task.team));

teamTasks.addEventListener("submit", (event)=> {
  event.preventDefault();

  const formData = new FormData(teamTasks);
})



function groupByTeams(tasks) {
  return tasks.reduce((prev, curr) => {
    if (!prev[curr.team]) {
      prev[curr.team] = [];
    }
    prev[curr.team].push(curr);
    return prev;
  }, {});
}

const groups = groupByTeams(tasks);
const snippet = Object.entries(groups).map(([group, teamTasks]) => {
  return Array.from(teams)
    .map((team) => {
      if (group === team) {
       return Array.from(teamTasks).map((task) => {
        return `
          <tr>
            <td>${task.team}</td>
            <td>
              <a href="task_view.php?task_id?=${task.task_id}">
                ${task.task_name}
              </a>
            </td>
            <td>
              <span class="bdg bdg-${statusColor(task.status)}">${task.status}</span>
            </td>
            <td>
              ${new Date(task.due_date)}
            </td>
          </tr>
        `;}).join("\n")
      }
    })
    .join("\n");
});

const list = `
    <form action="dashboard.php" method="POST">
      <select name="team" id="team">
        <option value="%%">All</option> ` +
  Array.from(teams).map((team) => `<option value="${team}">${team}</option>`).join("\n") +
  `
      </select>
      <button class="btn btn-sm btn-light" type="submit">filter</button>
    </form>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Team</th>
          <th scope="col">Task</th>
          <th scope="col">Status</th>
          <th scope="col">Due Date</th>
        </tr>
      </thead>
      <tbody>
` +
  snippet.join("\n") +
  `
      </tbody>
    </table>
`;
teamTasks.innerHTML = list;
});

