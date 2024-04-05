<?php

declare(strict_types=1);
/**
 * Personal tasks page.
 * All tasks assigned to the user are displayed here. 
 */
?>

<?php include("../partials/header.php") ?>
<?php include("../partials/tasks.php") ?>
<div class="btn-wrapper">
  <?php echo back_btn("../private/dashboard.php"); ?>
  <?php include_once("../partials/create_dialog.php") ?>
</div>
<?php include("../partials/footer.php") ?>