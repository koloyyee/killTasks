<?php
// youtube reference for php register: https://www.youtube.com/watch?v=LC9GaXkdxF8
  // The landing page with login.
if(isset($_SESSION['user_id'])) {
    header("Location: private/dashboard.php");
} else {
    header("Location: auth/login.php ");
}
?>
<?php include("./partials/header.php") ?>
  <!-- <canvas id="myChart"></canvas> -->
</div>
<?php include("./partials/footer.php") ?>
<script>
</script>