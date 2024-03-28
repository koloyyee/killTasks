<?php

include ("../partials/login_form.php");
include ("../partials/register_form.php");
$has_account= false;
echo $has_account;
// trying out HTMX soon.
?>

<?php include("../inc/header.php") ?>
<?php if ($conn) : ?>
    <?php if($has_account) : ?> 
        <?= login() ?>
        <a href="." onclick="setHasAccount">No account? Register!</a>
    <?php else: ?>
        <?= register() ?>
         <a href="." onclick="setHasAccount">Got an account? Login!</a>
    <?php endif ?>
    <!-- <?= login() ?> -->
<?php else : ?>
    <h3> Talk to your developer</h3>
<?php endif ?>

<script>
    let hasAccount = <?= $has_account ?>;
    function setHasAccount() {
      hasAccount = !hasAccount;
    }
</script>
<?php include("../inc/footer.php") ?>