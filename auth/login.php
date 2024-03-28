<?php
// youtube reference: https://www.youtube.com/watch?v=LC9GaXkdxF8
/***
 * login.php the file to handle login
 */
include ("../partials/login_form.php")
?>

<?php include("../inc/header.php") ?>
<?php if ($conn) : ?>
    <?= login() ?>
<?php else : ?>
    <h3> Talk your developer</h3>
<?php endif ?>
<?php include("../inc/footer.php") ?>