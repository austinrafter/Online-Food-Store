<?php
session_start();

$errors = array();
if (isset($_POST['continuetoship']))
{
  $name =$_POST['firstname'];
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

  if(empty($cardname)){
    $errors['cardname'] = "Cardname required";
  }

  if(empty($cardnumber)){
    $errors['cardnumber'] = "Cardnumber required";
  }

  if(empty($expmonth)){
    $errors['expmonth'] = "Expiration month for card required";
  }

  if(empty($expyear)){
    $errors['expyear'] = "Expiration year for card required";
  }

  if(empty($cvv)){
    $errors['cvv'] = "Security code for card required";
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
  $name =$_POST['firstname'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zipcode = $_POST['zip'];


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


  //if no errors
  if(count($errors === 0))
  {

      header("location: shipping.php");
  }

}
 ?>
