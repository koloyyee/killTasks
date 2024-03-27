<?php
session_start();

$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
$sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";

require('../config/pdo.php');
try{
 $row = $conn->query($sql) ;
 if(!empty($row)) {
  $_SESSION['email'] = $email;
  foreach($row as $r) {
  $_SESSION['first_name'] = $r['first_name'];
  $_SESSION['last_name'] = $r['last_name'];
  }
  header("Location: ../private/dashboard.php");
 } else {
  header("Location: ../auth/login.php");
 }

} catch ( PDOException $e) {
    echo "Error: " . $sql . "<br>" . $e->getMessage();
}
