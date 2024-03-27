<?php

?>
<?php include("../partials/header.php") ?>

  <form action="../service/register.php" method="post">
    <label for="first_name">First Name
      <input type="text" name="first_name" id="first_name">
    </label>
    <label for="last_name">Last Name
      <input type="text" name="last_name" id="last_name">
    </label>
    <label for="email"> Email
      <input type="email" name="email" id="email">
    </label>
    <label for="password"> Password
      <input type="password" name="password" id="word">
    </label>
    <button type="submit">Register</button>
    <button type="reset">Reset</button>
  </form>
  <a href="./login.php"> Got an account? Login!</a>

<?php include("../partials/footer.php") ?>
