<?php
session_start();
echo "You have been logged out";
echo "<br>Redirecting to login page...<br>";
session_destroy();
sleep(1);
header("Location: ../auth/login.php");