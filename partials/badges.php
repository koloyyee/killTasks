<?php

function status_badge($status)
{
  $color = "";
  switch (strtolower($status)) {
    case "working":
      $color = "warning";
      break;
    case "completed":
      $color = "success";
      break;
    case "overdue":
      $color = "danger";
      break;
    default:
      $color = "light";
      break;
  }
  return "<span class='badge text-bg-" . $color  . "'>" . $status . "</span>";
}