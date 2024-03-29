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

$message = "";
$pdo = new PdoDao();
$conn = $pdo->get_pdo();

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    $email = sanitize($_POST['email'], Input::email);
    $password = $_POST['password'];
    try {
        $response = Auth::login($conn, $email, $password);
        $message = $response->success === false ?  "<p class='text-red-500'> $response->message </p>" : "";
        sleep(1);
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
            <form class=" flex flex-col " action='login.php' method='POST'>
                <label for='email'>Email</label>
                <input type='text' name='email' id='email' require>
                <label for='password'>Password</label>
                <input type='password' name='password' id='password' required>
                <button type='submit' class="bg-blue-200 mt-5">Login</button>
            </form>
            <a href='register.php'>No account? Register!</a>
            <?= $message ?>
        </div>
    </section>
<?php else : ?>
    <h3> Talk your developer</h3>
<?php endif ?>
<?php include("../partials/footer.php") ?>