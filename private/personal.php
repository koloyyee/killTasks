<?php
declare(strict_types=1);
/**
 * Personal tasks page.
 * All tasks assigned to the user are displayed here. 
 */
$page_name = "Personal Tasks";
?>

<?php include("../partials/header.php") ?>
<?= $page_name ?>
<?php include("../partials/tasks.php") ?>
<?php include_once("../partials/create_dialog.php") ?>
<?php include("../partials/footer.php") ?>