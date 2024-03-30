<?php

declare(strict_types=1);
include_once("../config/pdo.php");
include_once("../service/user.php");
include_once("../model/user.php");
include_once("../model/response.php");
include_once("../utils/checkers.php");

$first_name_err = $last_name_err = $email_err = $password_err = $result_msg = "";
$first_name = $last_name = $email = $password = "";

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
  if (validate($_POST['first_name'], Fields::first_name)) {
    $first_name = sanitize($_POST['first_name'], Input::string);
  } else {
    $first_name_err = "First name is required";
  }
  if (validate($_POST['last_name'], Fields::last_name)) {
    $last_name = sanitize($_POST['last_name'], Input::string);
  } else {
    $last_name_err = "Last name is required";
  }
  if (validate($_POST['email'], Fields::email)) {
    $email = sanitize($_POST['email'], Input::email);
  } else {
    $email_err = "Email is required";
  }
  if (validate($_POST['password'], Fields::password)) {
    $password = sanitize($_POST['password'], Input::password);
  } else {
    $password_err = "Password is required";
  }

  if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password)) {
    $pdo = new PdoDao();
    $conn = $pdo->get_pdo();
    $service = new UserService($conn);
    $newUser = new User(null, $first_name, $last_name, $email, $password); 
    $result = $service->create_user($newUser);
    if ($result->success) {
      unset($first_name, $last_name, $email, $password);
      unset($first_name_err, $last_name_err, $email_err, $password_err);
      unset($_POST);
      header("Location: ./login.php");
    } else {
      $result_msg = $result->message;
    }
  }
}


?>
<?php include("../partials/header.php") ?>
<section class="auth_page">
  <div class="blue-bg bg-gradient-to-r from-blue-200 col-span-6 h-[95vh]"></div>
  <div class="form-section md:w-1/2 w-max justify-content-md-center align-self-center">
    <p class="err_msg"><?= $result_msg ?></p>
    <form id="register_form" class="d-flex flex-column " action='register.php' method='post'>
      <label class="form-label" for='first_name'>First Name
      </label>
      <input  class="form-control" type='text' name='first_name' id='first_name'>
      <small class="err_msg"> <?= $first_name_err ?> </small>
      <label class="form-label"  for='last_name'>Last Name
      </label>
      <input  class="form-control" type='text' name='last_name' id='last_name'>
      <small class="err_msg"><?= $last_name_err ?></small>
      <label  class="form-label" for='email'> Email
      </label>
      <input  class="form-control" type='email' name='email' id='email'>
      <small class="err_msg"> <?= $email_err ?></small>
      <label  class="form-label" for='password'> Password
      </label>
      <input  class="form-control" type='password' name='password' id='password'>
      <small class="err_msg"><?= $password_err ?></small>

      <div class="d-flex" >
      <button id="submit" type='submit' class="btn btn-primary p-2 w-50 m-2">Register</button>
      <button type='reset' class="btn btn-danger w-50 m-2">Reset</button>

      </div>
    </form>
    <a href='./login.php'> Got an account? Login!</a>
  </div>
</section>

<script type="module" src="../public/js/register.js" ></script>
<?php include("../partials/footer.php") ?>