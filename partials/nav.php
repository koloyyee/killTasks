<?php 

  $items = [
    'Dashboard'=> '../private/dashboard.php',
    'Personal' => '../private/personal.php',
    'Settings' => '../private/settings.php',
    'Login'=> '../auth/login.php',
  ]

?>

<nav>
  <ul>
    <?php foreach($items as $li => $link): ?>
      <li><a href="<?php echo $link ?>"><?php echo $li ?></a></li>
      <?php endforeach; ?>
  </ul>
</nav>