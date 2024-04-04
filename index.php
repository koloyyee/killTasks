<?php
/**
 * This file is the entry point of the application
 * It redirects the user to the login page if they are not logged in
 * by checking if the user_id session variable has user_id. 
 * 
 */
if(isset($_SESSION['user_id'])) {
    header("Location: private/dashboard.php");
} else {
    header("Location: auth/login.php ");
}
?>
<?php include("./partials/header.php") ?>

<?php include("./partials/footer.php") ?>
<script>
</script>