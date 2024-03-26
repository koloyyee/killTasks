<?php
// youtube reference for php register: https://www.youtube.com/watch?v=LC9GaXkdxF8

  // The landing page with login.
  $_SESSION['user_id'] = 1;
  $_SESSION['user_name'] = "abc";

  $array = array(
    "name" => "david",
    "age" => 23,
    "company" => "killtasks"
  );

  $jsarr = json_encode($array);
?>
<?php include("./partials/header.php") ?>
  <?= var_dump($_SESSION) ?> 
  <?= var_dump($jsarr) ?>
  <div>
  <!-- <canvas id="myChart"></canvas> -->
</div>
<?php include("./partials/footer.php") ?>
<script>
  const jsdata = <?= $jsarr ?>;
  // console.log(data);
</script>