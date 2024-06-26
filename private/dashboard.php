<?php

declare(strict_types=1);
include_once("../server/service/task.php");
include_once("../server/utils/convertors.php");
include_once("../server/utils/checkers.php");
include_once("../partials/badges.php");


$service = new TaskService();

$stats =  $service->group_by_team();
$team = sanitize("%%", Input::string);
$tasks = $service->get_tasks_by_team($team);

$group_by = array();
if (!isset($tasks) || empty($tasks)) {
  echo "<h1> No tasks found </h1>";
  return;
} else {
  foreach ($tasks as $key => $value) {
    $group_by[$value->get_team()][] = $value;
    $json = json_encode($group_by);
  }
}
$dup_teams = array_map(fn ($task): string => $task->get_team(), $tasks);
/**
 * Remove duplicates from array
 */
function set(array $data): array
{
  $result = [];
  foreach ($data as $key => $value) {
    if (in_array($value, $result)) {
      continue;
    }
    $result[] = $value;
  }
  return $result;
}
$teams = set($dup_teams);


if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
  if (isset($_POST['team'])) {
    $team = sanitize($_POST['team'], Input::string);
    $service = new TaskService();
    $result = $service->get_tasks_by_team($team);
    $group_by = array();
    foreach ($result as $key => $value) {
      $group_by[$value->get_team()][] = $value;
      $json = json_encode($group_by);
    }
  }
}

?>

<?php include("../partials/header.php") ?>
<main id="dashboard">
  <!-- <div id="chart" class="chart-container" style="position: relative; height:40vh;">
    <canvas id="myChart"></canvas>
  </div> -->
  <div id="teams_tasks" class="table-responsive">
    <form action="dashboard.php" method="POST">
      <select name="team" id="team">
        <option value="%%">All</option>
        <?php foreach ($teams as $team) : ?>
          <option value="<?= $team ?>"><?= $team; ?></option>
        <?php endforeach; ?>
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
        <?php foreach ($teams as $team) : ?>
          <?php if (isset($group_by[$team])) : ?>
            <?php foreach ($group_by[$team] as $task) : ?>
              <tr>
                <td><?= $task->get_team() ?></td>
                <td>
                  <a href="task_view.php?task_id=<?= $task->get_task_id() ?>">
                    <?= $task->get_task_name() ?>
                  </a>
                </td>
                <td><?= status_badge($task->get_status()) ?></td>
                <td><?= string_to_date($task->get_due_date(), 'Y/m/d') ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
    <div id="create_task">
    <?php include("../partials/create_dialog.php") ?>
    </div>
</main>


<!-- <script src="../public/js/tasks.js" type="module" defer></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<!-- <script>
  const stats = <?= json_encode($stats) ?>;
  const labels = [];
  const data = [];
  Object.values(stats).forEach(row => {
    labels.push(row.team);
    data.push(row.count);
  })

  const ctx = document.getElementById('myChart');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels,
      datasets: [{
        label: 'Tasks by Team',
        data,
        borderWidth: 1,
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)',
          'rgb(55, 205, 50)',
        ],
        hoverOffset: 4
      }]
    },
  });
</script> -->
<?php include("../partials/footer.php") ?>