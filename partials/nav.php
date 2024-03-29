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
 $welcome = "Welcome back! " . $_SESSION['first_name'] . " " . $_SESSION['last_name'];
?>
<nav class="flex justify-between px-5">
  <ul class="nav_item flex gap-5">
    <?php foreach ($items as $li => $link) : ?>
      <li><a href="<?php echo $link ?>"><?php echo $li ?></a></li>
    <?php endforeach; ?>
  </ul>
  <div>
    <?= $welcome ?>
  </div>
</nav>