<?php
session_start();


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
  }



?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Shipping Options</title>
  </head>
  <body>

    <form class="shippingoptions" action="shipping.php" method="post">
    <?php
    session_start();
    $downtown_zip = '95113'; ?>


    <?php

        if (isset($_POST['continuetofinish']))
        {
          $selected_option = $_POST["group"];
          $rushed = "rushed";
          $standard = "standard";

          if( $downtown_zip === $_SESSION["zip"])
          {
            $same_day = "same_day";

            if ($selected_option === $same_day)
            {
              $_SESSION["shipping_time"] = "Your groceries will be there by the end of the day";
              $_SESSION["shippingsameday"] = 5;
              header("location: fooddelivery.php");
            }
          }

            if ($selected_option === $rushed)
            {
              $_SESSION["shipping_time"] = "Your groceries will ship in 1 day";
              $_SESSION["shippingrushed"] = 2;
              header("location: fooddelivery.php");
            }

            if($selected_option ===$standard)
            {
              $_SESSION["shipping_time"] = "Your groceries will ship in 2-3 days";
              $_SESSION["shippingstandard"]  = 0;
              header("location: fooddelivery.php");
            }


        }

          ?>
    <div>
    <h3>Shipping Options</h3>

    <?php
    if( $downtown_zip === $_SESSION["zip"]){ ?>

      <label>
        <input type="radio" class="radio" value="same_day" id="same_day" name="group" />Same Day Shipping</label>
      <?php
      }
  ?>
<label>
  <input type="radio" class="radio" value="rushed" id="rushed" name="group" />Rushed 1 Day Shipping</label>
<label>
  <input type="radio" class="radio" value="standard" id="standard" name="group" />Standard 2-3 Day Shipping</label>
</label>
<br>
  <input type="submit" value="Continue to finish order" class="btn" name="continuetofinish">
</div>

    </form>
    <br>
    <a href="logout.php" class="logout"> Logout </a>




  </body>
</html>

