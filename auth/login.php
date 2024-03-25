// a login page
// youtube reference: https://www.youtube.com/watch?v=LC9GaXkdxF8
<?php
session_start();

if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
} else {
    header("Location: login.php");
}
