<?php


function register()
{
  return "
         <form action='../service/register.php' method='post'>
    <label for='first_name'>First Name
      <input type='text' name='first_name' id='first_name' required>
    </label>
    <label for='last_name'>Last Name
      <input type='text' name='last_name' id='last_name' required>
    </label>
    <label for='email'> Email
      <input type='email' name='email' id='email' required>
    </label>
    <label for='password'> Password
      <input type='password' name='password' id='word' required minlength='8'>
    </label>
    <button type='submit'>Register</button>
    <button type='reset'>Reset</button>
  </form>
  <a href='./login.php'> Got an account? Login!</a>
 
    ";
}
