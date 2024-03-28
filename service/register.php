<?php
require("../config/pdo.php");

enum Input{
  case string;
  case email;
  case password; 
};

$first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_SPECIAL_CHARS);
$last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


function check_input( string $input, Input $type ) {
  $input = trim($input);
  switch($type) {
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



$sql = "INSERT INTO user (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

echo $sql;
# $conn->query($sql);