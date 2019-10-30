<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <form class="shippingoptions" action="shipping.html" method="post">


    <?php
    session_start();
    if( 95113 === $_SESSION["zipcode"]){ ?>

      <input type='button' id='sameday' value='Same Day Shipping' >
      <?php
      }
  ?>
      <input type='button' id='rushed' value='Rushed Shipping' >
      <input type='button' id='standard' value='Standard Shipping' >
    </form>
  </body>
</html>
