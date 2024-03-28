<?php

declare(strict_types=1);
session_start();
include("../config/pdo.php");

$uri = $_SERVER['REQUEST_URI'];
$is_login = str_contains(strtolower($uri), "login");
$is_register = str_contains(strtolower($uri), "register");
var_dump($_SESSION);

if (!$is_login && !$is_register) {
  if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta author="Durra, Candice, David">
  <title>KillTasks: Stay Ahead</title>
  <link rel="stylesheet" href="style/global.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <?php if (!$is_login  &&  !$is_register) : ?>
    <?php include("../partials/nav.php") ?>
  <?php endif ?>