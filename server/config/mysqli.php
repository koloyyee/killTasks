<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'admin'); // custom name and password
define('DB_PASS', 'admin');
define('DB_NAME', 'killtasks');

/**
 *  how to set up db user and password https://youtu.be/BUCiSSyIGGU?feature=shared&t=10065
 */

  // you can replace with this if your db is 3306
  // $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, ); 
  // if your db 3306 is in use
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, 3306);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

// echo "Connected successfully";
