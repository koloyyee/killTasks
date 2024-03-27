<?php
require("../config/pdo.php");

$first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_SPECIAL_CHARS);
$last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO user (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";
$conn->query($sql);