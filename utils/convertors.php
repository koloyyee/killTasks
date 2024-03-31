<?php

function string_to_date(?string  $date, string $format = "c")
{
  return $date  ?  date($format, strtotime($date)) : "";
}
