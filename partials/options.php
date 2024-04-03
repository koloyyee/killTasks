<?php

/**
 * render options for status select
 * @param array $statuses
 */
function status_options()
{
$statuses = ["Working", "Completed", "Overdue"];
  foreach ($statuses as $status) {
    echo "<option value='$status'>$status</option>";
  }
}

function category_options()
{
  $categories = ["Budget", "Promotion", "Meetings", "Review", "Other"];
  foreach ($categories as $category) {
    echo "<option value='$category'>$category</option>";
  }
}

function team_options()
{
  $teams = ["Marketing", "Sales", "Development", "Research", "Other"];
  foreach ($teams as $team) {
    echo "<option value='$team'>$team</option>";
  }
}