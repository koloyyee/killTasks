<?php

function string_to_date(?string  $date, string $format = "c")
{
  return $date  ?  date($format, strtotime($date)) : "";
}
function pprint($data)
{
  echo "<pre>";
  print_r($data);
  echo "</pre>";
}

/**
 * @param string $status
 * @return string - bootstrap color class
 */
function status_color(string $status): string
{
  switch (strtolower($status)) {
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