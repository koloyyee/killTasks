<?php

declare(strict_types=1);
// youtube reference: https://www.youtube.com/watch?v=LC9GaXkdxF8
/***
 * login.php the file to handle login
 */
# include("../partials/login_form.php");
include_once("../config/pdo.php");
include_once("../utils/checkers.php");
include_once("../service/auth.php");

$email_err = $password_err = $result_msg = "";
$email = $password= $message= "";
$pdo = new PdoDao();
$conn = $pdo->get_pdo();

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {

    if(validate($_POST['email'], Fields::email)){
        $email = sanitize($_POST['email'], Input::email);
    } else {
        $email_err = "Email is required";
    }
    if(validate($_POST['password'], Fields::password)){
        $password = $_POST['password'];
    } else {
        $password_err = "Password is required";
    }

    try {
        $response = AuthService::login($conn, $email, $password);
        $message = $response->success === false ?  "<p class='text-red-500'> $response->message </p>" : "";
        if ($response->success) {
            header("Location: ../private/dashboard.php");
        }
    } catch (PDOException $e) {
        echo "Error: " . $sql . "<br>" . $e->getMessage();
    }
}


?>

<?php include_once("../partials/header.php") ?>
<?php if ($conn) : ?>
    <section class="auth_page">
        <div class="bg-gradient-to-r from-blue-200 col-span-6 h-[95vh]"></div>

        <div class="md:w-1/2 w-max col-start-8 col-end-12 justify-self-center content-center">
            <form id="login_form" class=" flex flex-col " action='login.php' method='POST'>
                <label for='email'>Email</label>
                <input type='email' name='email' id='email'>
                <small class="err_msg"> <?= $email_err ?></small>
                <label for='password'>Password</label>
                <input type='password' name='password' id='password'>
                <small class="err_msg"> <?= $password_err ?></small>
                <button id="submit" type='submit' class="bg-blue-200 mt-5">Login</button>
            </form>
            <a href='register.php'>No account? Register!</a>
            <?= $message ?>
        </div>
    </section>
<?php else : ?>
    <h3> Talk your developer</h3>
<?php endif ?>
<script type="module" src="../public/js/login.js" defer></script>
<?php include("../partials/footer.php") ?>