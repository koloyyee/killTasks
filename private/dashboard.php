<?php
declare(strict_types=1);
include("../service/status.php");
include("../service/category.php");
include("../config/pdo.php");

$page_name = "Dashboard";

$pdo = new PdoDao();
$conn = $pdo->get_pdo();
$service = new CategoryService($conn);
$result =  $service->get_categories();
echo "<pre>";
print_r($result);
echo "</pre>";
?>

<?php include("../partials/header.php") ?>
<?= $page_name ?>

<?php include("../partials/footer.php") ?>