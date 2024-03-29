<?php
declare(strict_types=1);
include("../service/status.php");
include("../service/category.php");
include("../service/team.php");
include("../config/pdo.php");

$page_name = "Dashboard";

$pdo = new PdoDao();
$conn = $pdo->get_pdo();
$service = new TeamService($conn);
$result =  $service->get_team_with_members();
?>

<?php include("../partials/header.php") ?>
<?= $page_name ?>

<?php include("../partials/footer.php") ?>