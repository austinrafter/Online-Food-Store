<?php include 'shippingtobilling.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="row">
      <div class="col-75">
        <div class="container">
          <form method="post" action="shippinginfo.php">

            <div class="row">
              <div class="col-50">
                <h3>Shipping Address</h3>
                <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                <input type="text" id="email" name="email" placeholder="john@example.com">
                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                <label for="city"><i class="fa fa-institution"></i> City</label>
                <input type="text" id="city" name="city" placeholder="San Jose">

                <div class="row">
                  <div class="col-50">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" placeholder="CA">
                  </div>
                  <div class="col-50">
                    <label for="zip">Zip</label>
                    <input type="text" id="zip" name="zip" placeholder="95123">
                  </div>
                </div>
              </div>
              <input type="submit" value="Continue to shipping options" class="btn" name="continuetoshipping">

              <?php if(count($errors) > 0): ?>
                <div class="error">
                  <?php foreach ($errors as $error): ?>
                    <li> <?php echo $error; ?> </li>
                  <?php endforeach ?>
                </div>
              <?php endif ?>

            </form>
          </div>
        </div>
      </div>
    </div>


        <a href="logout.php" class="logout"> Logout </a>

  </body>
</html>
