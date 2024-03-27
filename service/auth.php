<?php
session_start();

$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "SELECT first_name, last_name, password FROM user WHERE email = '$email'";
// strcmp($password, $r['password']) || 
require('../config/pdo.php');
try {
    $row = $conn->query($sql);
    if (!empty($row)) {
        foreach ($row as $r) {
            if (!password_verify($password, $r['password'])) {
                header("Location: ../auth/login.php");
            } else {
                $_SESSION['first_name'] = $r['first_name'];
                $_SESSION['last_name'] = $r['last_name'];
                $_SESSION['session_id'] = session_create_id($r['first_name'] .  $r['last_name'] );
                $_SESSION['email'] = $email;
                header("Location: ../private/dashboard.php");
            }
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $sql . "<br>" . $e->getMessage();
}
