<?php
// youtube reference: https://www.youtube.com/watch?v=LC9GaXkdxF8
?>

<?php include("../partials/header.php") ?>
    <form action="../api/auth.php" method="POST">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <button type="submit">Login</button>
        <a href="register.php">No account? Register!</a>
    </form>

<?php include("../partials/footer.php") ?>
