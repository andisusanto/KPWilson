<?php include_once('checklogin.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    
    <link rel="stylesheet" type="text/css" href="css/weefer_claim.css">
  </head>
  <body>
    <div class="navigation">
      
      <ul>
          <li><a href="logout.php">log out</a></li>
          <li><a href="#">Master</a>
            <ul>
              <li><a href="location.php">Location</a>
              <li><a href="item.php">Item</a>
            </ul>
          </li>
          <li><a href="#">Transaction</a>
            <ul>
              <li><a href="mutation.php">Item Mutation</a></li>
            </ul>
          </li>
      </ul>

    </div>