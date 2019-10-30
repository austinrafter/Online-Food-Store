<?php

$errors = array();
if (isset($_POST['continuetoship']))
{
  $name = $_POST['firstname'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zipcode = $_POST['zip'];
  $cardname = $_POST['cardname'];
  $cardnumber = $_POST['cardnumber'];
  $expmonth = $_POST['expmonth'];
  $expyear = $_POST['expyear'];
  $cvv = $_POST['cvv'];


  //check that forms are filled in properly
  if(empty($name))
  {
    $errors['firstname'] = "Full name required";
  }


  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Email address is invalid";
  }

  if(empty($email)){
    $errors['email'] = "Email required";
  }

  if(empty($address)){
    $errors['address'] = "Address required";
  }

  if(empty($city)){
    $errors['city'] = "City required";
  }

  if(empty($state)){
    $errors['state'] = "State required";
  }

  if(empty($zipcode)){
    $errors['zip'] = "Zipcode required";
  }

  if(!is_numeric($zipcode))
 {
  $errors['zip'] = "Please enter a correct zipcode";
 }

  if(empty($cardname)){
    $errors['cardname'] = "Cardname required";
  }

  if(empty($cardnumber)){
    $errors['cardnumber'] = "Cardnumber required";
  }

  if(!is_numeric($cardnumber))
 {
  $errors['cardnumber'] = "Please enter a correct card number";
 }

  if(empty($expmonth)){
    $errors['expmonth'] = "Expiration month for card required";
  }

  if(!is_numeric($expmonth) || $expm < 1 || $expm > 12)
 {
  $errors['expmonth'] = "Please enter a correct month";
 }

  if(empty($expyear)){
    $errors['expyear'] = "Expiration year for card required";
  }

  if(!is_numeric($expmonth) || $expm < 2018 || $expm > 2032)
 {
  $errors['expmonth'] = "Please enter a correct year";
 }

  if(empty($cvv)){
    $errors['cvv'] = "Security code for card required";
  }

  if(preg_match('/^[0-9]{3,4}$/', $cvv))//use {3} for non-AMEX cards
{
	$errors['cvv'] = "Correct security code for card required";
}

  function luhn_check($cardnumber) {

  // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
  $number=preg_replace('/\D/', '', $cardnumber);

  // Set the string length and parity
  $number_length=strlen($cardnumber);
  $parity=$number_length % 2;

  // Loop through each digit and do the maths
  $total=0;
  for ($i=0; $i<$cardnumber_length; $i++) {
    $digit=$cardnumber[$i];
    // Multiply alternate digits by two
    if ($i % 2 == $parity) {
      $digit*=2;
      // If the sum is two digits, add them together (in effect)
      if ($digit > 9) {
        $digit-=9;
      }
    }
    // Total up the digits
    $total+=$digit;
  }

  // If the total mod 10 equals 0, the number is valid
  return ($total % 10 == 0) ? TRUE : FALSE;

}



  //if no errors
  if(count($errors === 0))
  {

    //check if sameadress button has been checked if so move to shipping if not move to shipping info
    if(isset($_POST['sameadr']))
    {

      header("location: shipping.php");


    }
    else
    {

      header("location: shippinginfo.php");
    }

  }

}

if (isset($_POST['continuetoshipping']))
{
  $name =$_POST['fname'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zipcode = $_POST['zip'];


  //check that forms are filled in properly
  if(empty($name))
  {
    $errors['fname'] = "Full name required";
  }


  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Email address is invalid";
  }

  if(empty($email)){
    $errors['email'] = "Email required";
  }

  if(empty($address)){
    $errors['address'] = "Address required";
  }

  if(empty($city)){
    $errors['city'] = "City required";
  }

  if(empty($state)){
    $errors['state'] = "State required";
  }

  if(empty($zipcode)){
    $errors['zip'] = "Zipcode required";
  }


  //if no errors
  if(count($errors === 0))
  {

      header("location: shipping.php");
  }

}
 ?>