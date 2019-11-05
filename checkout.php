<?php include 'shippingtobilling.php'; ?>



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
    <title></title>
    <link rel="stylesheet" type="text/css" href="style_checkout.css">
  </head>
  <body>

    <div class="row">
      <div class="col-75">
        <div class="container">
          <form method="post" action="checkout.php">

            <div class="row">
              <div class="col-50">
                <h3>Billing Address</h3>
                <label for="fname"><i class="fa fa-user"></i> First and last name</label>
                <input type="text" id="fname" name="firstname" placeholder="John Doe" value="<?php echo $name; ?>">
                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                <input type="text" id="email" name="email" placeholder="john@gmail.com" value="<?php echo $email; ?>">
                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                <input type="text" id="adr" name="address" placeholder="542 15th Street" value="<?php echo $address; ?>">
                <label for="city"><i class="fa fa-institution"></i> City</label>
                <input type="text" id="city" name="city" placeholder="San Jose" value="<?php echo $city; ?>">

                <div class="row">
                  <div class="col-50">
                    <label for="state">State</label>
                    <select class="state" name="state_selection" value="<?php echo $state; ?>" >
                      <option value="AL">Alabama</option>
                      	<option value="AK">Alaska</option>
                      	<option value="AZ">Arizona</option>
                      	<option value="AR">Arkansas</option>
                      	<option value="CA">California</option>
                      	<option value="CO">Colorado</option>
                      	<option value="CT">Connecticut</option>
                      	<option value="DE">Delaware</option>
                      	<option value="DC">District Of Columbia</option>
                      	<option value="FL">Florida</option>
                      	<option value="GA">Georgia</option>
                      	<option value="HI">Hawaii</option>
                      	<option value="ID">Idaho</option>
                      	<option value="IL">Illinois</option>
                      	<option value="IN">Indiana</option>
                      	<option value="IA">Iowa</option>
                      	<option value="KS">Kansas</option>
                      	<option value="KY">Kentucky</option>
                      	<option value="LA">Louisiana</option>
                      	<option value="ME">Maine</option>
                      	<option value="MD">Maryland</option>
                      	<option value="MA">Massachusetts</option>
                      	<option value="MI">Michigan</option>
                      	<option value="MN">Minnesota</option>
                      	<option value="MS">Mississippi</option>
                      	<option value="MO">Missouri</option>
                      	<option value="MT">Montana</option>
                      	<option value="NE">Nebraska</option>
                      	<option value="NV">Nevada</option>
                      	<option value="NH">New Hampshire</option>
                      	<option value="NJ">New Jersey</option>
                      	<option value="NM">New Mexico</option>
                      	<option value="NY">New York</option>
                      	<option value="NC">North Carolina</option>
                      	<option value="ND">North Dakota</option>
                      	<option value="OH">Ohio</option>
                      	<option value="OK">Oklahoma</option>
                      	<option value="OR">Oregon</option>
                      	<option value="PA">Pennsylvania</option>
                      	<option value="RI">Rhode Island</option>
                      	<option value="SC">South Carolina</option>
                      	<option value="SD">South Dakota</option>
                      	<option value="TN">Tennessee</option>
                      	<option value="TX">Texas</option>
                      	<option value="UT">Utah</option>
                      	<option value="VT">Vermont</option>
                      	<option value="VA">Virginia</option>
                      	<option value="WA">Washington</option>
                      	<option value="WV">West Virginia</option>
                      	<option value="WI">Wisconsin</option>
                      	<option value="WY">Wyoming</option>
                    </select>
                  </div>
                  <div class="col-50">
                    <label for="zip">Zip</label>
                    <input type="text" id="zip" name="zip" placeholder="95123" value="<?php echo $zipcode; ?>">
                  </div>
                </div>
              </div>

              <div class="col-50">
                <h3>Payment</h3>
                <label for="cardtype">Accepted Cards</label>

                  <select class="cardtype" name="cardtype">
                        <option value="visa">Visa</option>
                      	<option value="AMEX">AMEX</option>
                        <option value="mastercard">Mastercard</option>
                        <option value="discover">Discover</option>
                  </select>

                </div>
                <label for="cname">Name on Card</label>
                <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                <label for="ccnum">Credit card number</label>
                <input type="text" id="ccnum" name="cardnumber" placeholder="1111222233334444">

                <label>Expiration Date: </label>
        <select id="cc-exp-month" name="expmonth">
            <option value="01">Jan</option>
            <option value="02">Feb</option>
            <option value="03">Mar</option>
            <option value="04">Apr</option>
            <option value="05">May</option>
            <option value="06">Jun</option>
            <option value="07">Jul</option>
            <option value="08">Aug</option>
            <option value="09">Sep</option>
            <option value="10">Oct</option>
            <option value="11">Nov</option>
            <option value="12">Dec</option>
        </select>
        <select id="cc-exp-year" name="expyear">
            <option value="20">2020</option>
            <option value="21">2021</option>
            <option value="22">2022</option>
            <option value="23">2023</option>
            <option value="24">2024</option>
            <option value="25">2025</option>
            <option value="26">2026</option>
            <option value="27">2027</option>
            <option value="28">2028</option>
            <option value="29">2029</option>
        </select>
        <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>

            </div>
            <label>
              <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
            </label>
            <input type="submit" value="Continue to shipping options" class="btn" name="continuetoship">
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

      <a href="logout.php" class="logout"> Logout </a>
  </body>
</html>
