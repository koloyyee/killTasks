<?php

/**
 * render options for status select
 * @param array $statuses
 */
function status_options(?string $prev_val)
{
$statuses = ["Working", "Completed", "Overdue"];
  foreach ($statuses as $status) {
    $selected = strtolower($status) === strtolower($prev_val) ? " selected='selected' " : '' ;
    echo "<option value='$status' " . $selected. "> $status</option>";
  }
}

function category_options(?string $prev_val)
{
  $categories = ["Budget", "Promotion", "Meetings", "Review", "Other"];
  foreach ($categories as $category) {
    $selected = strtolower($category) === strtolower($prev_val) ? " selected='selected' " : '' ;
    echo "<option value='$category'" . $selected . ">$category</option>";
  }
}

function team_options(?string $prev_val)
{
  $teams = ["Marketing", "Sales", "Development", "Research", "Other"];
  foreach ($teams as $team) {
    $selected = strtolower($team) === strtolower($prev_val) ? " selected='selected' " : '' ;
    echo "<option value='$team'" . $selected . ">$team</option>";
  }
}

function role_options(?string $prev_val)
{
  $roles = ["Admin", "Manager", "Member"];
  foreach ($roles as $role) {
    $selected = strtolower($role) === strtolower($prev_val) ? " selected='selected' " : '' ;
    echo "<option value='$role'" . $selected . ">$role </option>";
  }
}