<?php
// youtube reference: https://www.youtube.com/watch?v=LC9GaXkdxF8
/***
 * login.php the file to handle login
 */
# include("../partials/login_form.php");
include_once("../config/pdo.php");
?>

<?php include_once("../partials/header.php") ?>
<?php if ($conn) : ?>
    <form action='../service/login.php' method='POST'>
        <label for='email'>Email</label>
        <input type='text' name='email' id='email' require>
        <label for='password'>Password</label>
        <input type='password' name='password' id='password'required>
        <button type='submit'>Login</button>
    </form>
    <a href='register.php'>No account? Register!</a>

<?php else : ?>
    <h3> Talk your developer</h3>
<?php endif ?>
<?php include("../partials/footer.php") ?>