<?php
    include_once('checklogin.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
  </head>
  <body>
      <form method="post" action="processchangepasswordonlogin.php">
          <p>Password :<br>
          <input type="password" name="txtPassword" placeholder="Password"/></p>
          <p>Confirm Password :<br>
          <input type="password" name="txtConfirmPassword" placeholder="Password"/></p>
          <input type="submit"/>
      </form>
  </body>
</html>