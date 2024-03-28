<?php
# include("../partials/register_form.php");
declare(strict_types=1);
enum Input
{
  case string;
  case email;
  case password;
};

function check_input(string $input, Input $type)
{
  $input = trim($input);
  switch ($type) {
    case Input::string:
      return filter_var($input, FILTER_SANITIZE_SPECIAL_CHARS);
    case Input::email:
      return filter_var($input, FILTER_VALIDATE_EMAIL);
    case Input::password:
      return password_hash($input, PASSWORD_DEFAULT);
    default:
      return "";
  }
}

var_dump($_POST);
if (isset($_POST['email'], $POST['password'], $_POST['first_name'], $_POST['last_name']) ) {
  $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_SPECIAL_CHARS);
  $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO user (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

  echo $sql;
}
?>
<?php include("../../src/inc/header.php") ?>

<form action='<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>' method='post'>
  <label for='first_name'>First Name
    <input type='text' name='first_name' id='first_name' required>
  </label>
  <label for='last_name'>Last Name
    <input type='text' name='last_name' id='last_name' required>
  </label>
  <label for='email'> Email
    <input type='email' name='email' id='email' required>
  </label>
  <label for='password'> Password
    <input type='password' name='password' id='word' required>
  </label>
  <button type='submit'>Register</button>
  <button type='reset'>Reset</button>
</form>
<a href='./login.php'> Got an account? Login!</a>

<?php include("../../src/inc/footer.php") ?>