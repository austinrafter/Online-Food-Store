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

    <script type="text/javascript">
            // the selector will match all input controls of type :checkbox
        // and attach a click event handler
        $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
          // the name of the box is retrieved using the .attr() method
          // as it is assumed and expected to be immutable
          var group = "input:checkbox[name='" + $box.attr("name") + "']";
          // the checked state of the group/box on the other hand will change
          // and the current value is retrieved using .prop() method
          $(group).prop("checked", false);
          $box.prop("checked", true);
        } else {
          $box.prop("checked", false);
        }
        });
    </script>
    <div>
    <h3>Shipping Options</h3>

    <?php
    if( $downtown_zip === $_SESSION["zip"]){ ?>

      <label>
        <input type="radio" class="radio" value="same_day" id="same_day" name="group[1][]" />Same Day Shipping</label>
      <?php
      }
  ?>
<label>
  <input type="radio" class="radio" value="rushed" id="rushed" name="group[1][]" />Rushed 1 Day Shipping</label>
<label>
  <input type="radio" class="radio" value="standard" id="standard" name="group[1][]" />Standard 2-3 Day Shipping</label>
</label>
<br>
  <input type="submit" value="Continue to finish order" class="btn" name="continuetofinish">
</div>

    </form>
    <br>
    <a href="logout.php" class="logout"> Logout </a>



<?php

    if (isset($_POST['continuetofinish']))
    {
      ?>
      <script type="text/javascript">
        var sameDay = document.getElementById("same_day").value;
          var rushed = document.getElementById("rushed").value;
          var standard = document.getElementById("standard").value;

          <?php $_SESSION["same_day"] = "<script>document.write(sameDay)</script>";
                $_SESSION["rushed"] = "<script>document.write(rushed)</script>";
                $_SESSION["standard"] = "<script>document.write(standard)</script>";
           ?>

          </script>
        <?php


        if (isset($_SESSION["same_day"]))
        {
          $_SESSION["shipping_time"] = "Your groceries will be there by the end of the day";
          $_SESSION["shippingsameday"] = 5;
          header("location: fooddelivery.php");
        }
        elseif (isset($_SESSION["rushed"]))
        {
          $_SESSION["shipping_time"] = "Your groceries will ship in 1 day";
          $_SESSION["shippingrushed"] = 2;
          header("location: fooddelivery.php");
        }
        elseif(isset($_SESSION["standard"]))
        {
          $_SESSION["shipping_time"] = "Your groceries will ship in 2-3 days";
          $_SESSION["shippingstandard"]  = 0;
          header("location: fooddelivery.php");
        }
        else{
          echo "you did not make a choice";
        }

    }

      ?>

  </body>
</html>
