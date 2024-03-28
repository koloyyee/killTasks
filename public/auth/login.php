<?php
// youtube reference: https://www.youtube.com/watch?v=LC9GaXkdxF8
/***
 * login.php the file to handle login
 */
# include("../partials/login_form.php");

?>

<?php include("../inc/header.php") ?>
<?php if ($conn) : ?>
    <!-- <?= login() ?> -->
    <form action='../service/auth.php' method='POST'>
        <label for='email'>Email</label>
        <input type='text' name='email' id='email'>
        <label for='password'>Password</label>
        <input type='password' name='password' id='password'>
        <button type='submit'>Login</button>
    </form>
    <a href='register.php'>No account? Register!</a>

<?php else : ?>
    <h3> Talk your developer</h3>
<?php endif ?>
<?php include("../inc/footer.php") ?>