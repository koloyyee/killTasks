<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'admin'); // custom name and password
define('DB_PASS', 'admin');
define('DB_NAME', 'killtasks');

$dns = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=3307";
try {
  $conn = new PDO($dns, DB_USER, DB_PASS);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $conn;
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
