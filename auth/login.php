<?php
// a login page
// youtube reference: https://www.youtube.com/watch?v=LC9GaXkdxF8
// session_start();

// if(isset($_SESSION['user_id'])) {
//     header("Location: index.php");
// } else {
//     header("Location: login.php");
// }

$array = array(
    "name" => "david",
    "age" => 23,
    "company" => "killtasks"
);
?>

<?php include("../partials/header.php") ?>
    <form action="">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </form>
    <?php foreach($array as $key => $value) { ?>
        <p><?= $key ?>: <?= $value ?></p>
    <?php } ?>

<?php include("../partials/footer.php") ?>
