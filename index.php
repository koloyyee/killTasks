<?php
// youtube reference for php register: https://www.youtube.com/watch?v=LC9GaXkdxF8

  // The landing page with login.
  $_SESSION['user_id'] = 1;
  $_SESSION['user_name'] = "abc";

?>
<?php include("./partials/header.php") ?>
  <?= session_id() ?> 
  <div>
  <canvas id="myChart"></canvas>
</div>
<?php include("./partials/footer.php") ?>