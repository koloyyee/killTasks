<?php

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

?>

<nav>
  <ul class="nav_item">
    <?php foreach ($items as $li => $link) : ?>
      <li><a href="<?php echo $link ?>"><?php echo $li ?></a></li>
    <?php endforeach; ?>
  </ul>
</nav>