<?php

/**
 * render options for status select
 * @param array $statuses
 */
$statuses = ["Working", "Completed", "Overdue"];
function status_options($statuses)
{
  foreach ($statuses as $status) {
    echo "<option value='$status'>$status</option>";
  }
}
