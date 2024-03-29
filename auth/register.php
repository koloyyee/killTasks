<?php

declare(strict_types=1);
include_once("../config/pdo.php");
include_once("../service/auth.php");
include_once("../utils/checkers.php");

$first_name_err = $last_name_err = $email_err = $password_err = "";
$first_name = $last_name = $email = $password = "";

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
  if (validate($_POST['first_name'], RegisterFields::first_name)) {
    $first_name = sanitize($_POST['first_name'], Input::string);
  } else {
    $first_name_err = "First name is required";
  }
  if (validate($_POST['last_name'], RegisterFields::last_name)) {
    $last_name = sanitize($_POST['last_name'], Input::string);
  } else {
    $last_name_err = "Last name is required";
  }
  if (validate($_POST['email'], RegisterFields::email)) {
    $email = sanitize($_POST['email'], Input::email);
  } else {
    $email_err = "Email is required";
  }
  if (validate($_POST['password'], RegisterFields::password)) {
    $password = sanitize($_POST['password'], Input::password);
  } else {
    $password_err = "Password is required";
  }

  if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password)) {
    $result = Auth::register($conn, $first_name, $last_name, $email, $password);
    if ($result['success']) {
      unset($first_name, $last_name, $email, $password);
      unset($first_name_err, $last_name_err, $email_err, $password_err);
      unset($_POST);
      header("Location: ./login.php");
    } else {
      echo $result['message'];
    }
  }
}


?>
<?php include("../partials/header.php") ?>
<section class="auth_page">
  <div class="bg-gradient-to-r from-blue-200 col-span-6 h-[95vh]"></div>
  <div class="md:w-1/2 w-max col-start-8 col-end-12 justify-self-center content-center">
    <form class="flex flex-col" action='register.php' method='post'>
      <label for='first_name'>First Name
      </label>
      <input type='text' name='first_name' id='first_name'>
      <small class="err_msg"> <?= $first_name_err ?> </small>
      <label for='last_name'>Last Name
      </label>
      <input type='text' name='last_name' id='last_name'>
      <small class="err_msg"><?= $last_name_err ?></small>
      <label for='email'> Email
      </label>
      <input type='email' name='email' id='email'>
      <small class="err_msg"> <?= $email_err ?></small>
      <label for='password'> Password
      </label>
      <input type='password' name='password' id='word'>
      <small class="err_msg"><?= $password_err ?></small>

      <button type='submit' class="mt-5 bg-blue-200">Register</button>
      <button type='reset' class="mt-2 bg-red-200">Reset</button>
    </form>
    <a href='./login.php'> Got an account? Login!</a>
  </div>
</section>
<?php include("../partials/footer.php") ?>