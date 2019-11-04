<?php
session_start();

require_once "configshipandbill.php";

$errors = array();
$name = "";
$email = "";
$address = "";
$city = "";
$state = "";
$zipcode = "";


if (isset($_POST['continuetoship']))
{
  $name = $_POST['firstname'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state_selection'];
  $zipcode = $_POST['zip'];
  $cardtype = $_POST['cardtype'];
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

  if(!preg_match('/^[A-Za-z \'-]+$/i',$name)){
    $errors['firstname'] = "Please enter a name";
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


  if(!preg_match('/[A-Za-z0-9\-\\,.]+/', $address) ){
    $errors['address'] = "Please enter a valid address";
  }

  if(empty($city)){
    $errors['city'] = "City required";
  }

  /*if(empty($state)){
    $errors['state'] = "State required";
  }*/

  if(empty($zipcode)){
    $errors['zip'] = "Zipcode required";
  }

  if(!is_numeric($zipcode))
 {
  $errors['zip'] = "Please enter only numbers for the zipcode";
 }

if (!preg_match('/^[0-9]{5}?$/', $zipcode))
    {

  $errors['zip'] = "Please enter a 5 numbered zipcode";
    }


  if(empty($cardname)){
    $errors['cardname'] = "Cardname required";
  }

  if(!preg_match('/^[A-Za-z \'-]+$/i',$cardname)){
    $errors['cardname'] = "Please enter the name on card";
  }


  if(empty($cardnumber)){
    $errors['cardnumber'] = "Cardnumber required";
  }

  if(!is_numeric($cardnumber))
 {
  $errors['cardnumber'] = "Please enter only numbers for the card number";
}

  function validatecard($number)
 {
    global $type;

    $cardtype = array(
        "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
        "mastercard" => "/^5[1-5][0-9]{14}$/",
        "amex"       => "/^3[47][0-9]{13}$/",
        "discover"   => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
    );

    if (preg_match($cardtype['visa'],$number))
    {
	$type= "visa";
        return 'visa';
        echo "<green> $type detected. credit card number is valid</green>";

    }
    else if (preg_match($cardtype['mastercard'],$number))
    {
	$type= "mastercard";
        return 'mastercard';
        echo "<green> $type detected. credit card number is valid</green>";
    }
    else if (preg_match($cardtype['amex'],$number))
    {
	$type= "amex";
        return 'amex';
        echo "<green> $type detected. credit card number is valid</green>";

    }
    else if (preg_match($cardtype['discover'],$number))
    {
	$type= "discover";
        return 'discover';
        echo "<green> $type detected. credit card number is valid</green>";
    }
    else
    {
        return false;
        $errors['cardnumber'] = "Please enter a real card number";
    }
 }

validatecard($cardnumber);

function luhn_check($number) {

// Strip any non-digits (useful for credit card numbers with spaces and hyphens)
$number=preg_replace('/\D/', '', $number);

// Set the string length and parity
$number_length=strlen($number);
$parity=$number_length % 2;

//Loop through each digit and do the maths
$total=0;
for ($i=0; $i<$number_length; $i++) {
  $digit=$number[$i];
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

if(FALSE){
  $errors['cardnumber'] = "Not a valid card number";
}

}

luhn_check($cardnumber);

      if(empty($cvv)){
        $errors['cvv'] = "Security code for card required";
      }

      if(!is_numeric($cvv))
     {
      $errors['cardnumber'] = "Please enter only numbers for cvv number";
     }

    if (!preg_match('/^[0-9]{3,4}?$/', $cvv))
        {

      $errors['cvv'] = "Please enter the correct numbered CVV";
        }


  //if no errors
  if(count($errors) === 0)
  {
    $sql = "INSERT INTO billing(name, email, address, city, state, zip) VALUES('$_POST[firstname]','$_POST[email]','$_POST[address]','$_POST[city]','$_POST[state_selection]','$_POST[zip]',)";
    mysqli_query($conn,$sql);

    //check if sameadress button has been checked if so move to shipping if not move to shipping info
    if(isset($_POST['sameadr']))
    {
      $selected_val = ['state_selection'];
      $city_select = ['city'];

      if($selected_val !== "CA" || $city_select !== "San Jose"){
        $errors['state_selection'] = "We can only ship within california";
        $errors['state_selection'] = "We can only ship in San Jose";
      }


      //$sql = "INSERT INTO shipping(name, email,  address, city, state, zip) VALUES('$_POST[firstname]','$_POST[email]','$_POST[address]','$_POST[city]','$_POST[state]','$_POST[zip]',)";

      $_SESSION["zip"] = $zipcode;

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
  $name =$_POST['firstname'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  //$state = $_POST['state'];
  $zipcode = $_POST['zip'];


  //check that forms are filled in properly
  if(empty($name))
  {
    $errors['fname'] = "Full name required";
  }

  if(!preg_match('/^[A-Za-z \'-]+$/i',$name)){
    $errors['firstname'] = "Please enter a name";
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

  if(!preg_match('/[A-Za-z0-9\-\\,.]+/', $address) ){
    $errors['address'] = "Please enter a valid address";
  }

  if(empty($city)){
    $errors['city'] = "City required";
  }

  /*if(empty($state)){
    $errors['state'] = "State required";
  }*/

  if(empty($zipcode)){
    $errors['zip'] = "Zipcode required";
  }

  if(!is_numeric($zipcode))
 {
  $errors['zip'] = "Please enter a correct zipcode";
 }

 if(!preg_match('#[0-9]{5}#', $zipcode))
    {
      $errors['zip'] = "Please enter a valid zipcode";
    }



  //if no errors
  if(count($errors) === 0)
  {
    //$sql = "INSERT INTO shipping(name, email,  address, city, state, zip) VALUES('$_POST[fname]','$_POST[email]','$_POST[address]','$_POST[city]','$_POST[state]','$_POST[zip]',)";
      $_SESSION["zip"] = $zipcode;
      header("location: shipping.php");
  }

}
 ?>
