<?php

declare(strict_types=1);
// youtube reference: https://www.youtube.com/watch?v=LC9GaXkdxF8
/***
 * login.php the file to handle login
 */
include_once("../server/utils/checkers.php");
include_once("../server/service/auth.php");

/**
 * Error messages variables declaration
 * @var string $email_err, $password_err, $result_msg
 * 
 * Email, password and message variables declaration
 * @var string $email, $password, $message
 
 */
$email_err = $password_err = $result_msg = "";
$email = $password = $message = "";

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    if (validate($_POST['email'], Fields::email)) {
        $email = sanitize($_POST['email'], Input::email);
    } else {
        $email_err = "Email is required";
    }
    if (validate($_POST['password'], Fields::password)) {
        $password = $_POST['password'];
    } else {
        $password_err = "Password is required";
    }

    try {
        $service = new AuthService();
        $response = $service->login($email, $password);
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
<section class="auth_page">

    <div class="blue-bg bg-gradient-to-r from-blue-200 col-span-6 h-[95vh]"></div>
    <div class="form-section md:w-1/2 w-max justify-content-md-center align-self-center">
        <form id="login_form" class="d-flex flex-column " action='login.php' method='POST'>
            <label class="form-label" for='email'>Email</label>
            <input class="form-control" type='email' name='email' id='email'>
            <small class="err_msg"> <?= $email_err ?></small>
            <label class="form-label" for='password'>Password</label>
            <input class="form-control" type='password' name='password' id='password'>
            <small class="err_msg"> <?= $password_err ?></small>

            <div class="d-flex">
                <button type='reset' class="btn btn-danger w-50 m-2">Reset</button>
                <button id="submit" type='submit' class="btn btn-primary p-2 w-50 m-2">Login</button>
            </div>
        </form>
        <a href='register.php'>No account? Register!</a>
        <?= $message ?>
    </div>
</section>
<script type="module" src="../public/js/login.js" defer></script>
<?php include("../partials/footer.php") ?>