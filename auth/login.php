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
    <section class="auth_page">
        <div class="bg-gradient-to-r from-blue-200 col-span-6 h-[95vh]"></div>
    <div class="md:w-1/2 w-max col-start-8 col-end-12 justify-self-center content-center">
            <form class=" flex flex-col " action='../service/login.php' method='POST'>
                <label for='email'>Email</label>
                <input type='text' name='email' id='email' require>
                <label for='password'>Password</label>
                <input type='password' name='password' id='password' required>
                <button type='submit' class="bg-blue-200 mt-5">Login</button>
            </form>
            <a href='register.php'>No account? Register!</a>
        </div>
    </section>
<?php else : ?>
    <h3> Talk your developer</h3>
<?php endif ?>
<?php include("../partials/footer.php") ?>