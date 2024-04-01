<?php
declare(strict_types=1);
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
/**
 * Check the current URI to determine 
 * if is login or logout.
 * Nav will not be displayed if the user is on the login/register page
 */
$uri = $_SERVER['REQUEST_URI'];
$is_login = str_contains(strtolower($uri), "login");
$is_register = str_contains(strtolower($uri), "register");


if (!$is_login && !$is_register) {
  if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
  }
}

$items = [
  'Dashboard' => '../private/dashboard.php',
  'Personal' => '../private/personal.php',
  'Settings' => '../private/settings.php',
  'Login' => '../auth/login.php',
  'Logout' => '../auth/logout.php'
];
if (isset($_SESSION['session_id'])) {
  unset($items['Login']);
} else {
  unset($items['Logout']);
}
if (isset($_SESSION['first_name']) && isset($_SESSION['last_name'])) {
  $welcome = "Welcome back! " . $_SESSION['first_name'] . " " . $_SESSION['last_name'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta author="Durra, Candice, David">
  <title><?= 'KillTasks: Stay Ahead' ?></title>
  <link rel="stylesheet" href="../public/style/global.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <?php if (!$is_login  &&  !$is_register) : ?>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php foreach ($items as $li => $link) : ?>

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?php echo $link ?>"><?php echo $li ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
          <?php include("search.php") ?>
        <a class="navbar-brand d-flex gap-2 mx-3" href="#">
          <img id="logo" alt="killtasks logo" src="../assets/logo.jpg">
          <div class="align-self-end">
          <h4> KillTasks</h4>
          <small id="tag-line" ><em>Streamlining Your Life with Efficiency</em></small>
          </div>
        </a>
        </div>
      </div>
    </nav>
  <?php endif ?>