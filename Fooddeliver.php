<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
  }




  if (isset($_SESSION["same_day"])){
  $_SESSION["shippingoption"] = $_SESSION["shippingsameday"];
}
elseif (isset($_SESSION["rushed"])){
$_SESSION["shippingoption"] = $_SESSION["shippingrushed"];
}
elseif(isset($_SESSION["standard"])){
$_SESSION["shippingoption"] = $_SESSION["shippingstandard"];
}else{
  echo "you did not make a choice";
}



  if($_SESSION["weight"] >= 20){
    $_SESSION["shippingoption"] += 5;
  }

  $_SESSION["totalwithship"] = $_SESSION["shippingoption"] + $_SESSION["grand_total"];

  echo $_SESSION["totalwithship"];
  echo $_SESSION["shipping_time"];

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Food Delivery(Show total)</title>
  </head>
  <body>


    <a href="logout.php" class="logout"> Logout </a>
  </body>
</html>
