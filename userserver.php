<?php
session_start();

  $errors = array();
  $username = "";
  $email = "";

require_once 'config.php';


//if the register button is clicked
  if(isset($_POST['register-btn']))
{
    $username =$_POST['username'];
    $email = $_POST['email'];
    $pass_1 = $_POST['pass_1'];
    $pass_2 = $_POST['pass_2'];


  //check that forms are filled in properly
  if(empty($username))
  {
    $errors['username'] = "Username required";
  }


  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Email address is invalid";
  }

  if(empty($email)){
    $errors['email'] = "Email required";
  }

  if(empty($pass_1)){
    $errors['pass_1'] = "Password required";
  }

  if($pass_1 !== $pass_2){
      $errors['pass_1'] = "Passwords do not match.";
  }

  //check that email isnt already being used
  $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
  $stmt = $conn->prepare($emailQuery);
  $stmt->bind_param('s',$email);
  $stmt->execute();
  $result = $stmt->get_result();
  $userCount = $result->num_rows;
  $stmt->close();

  if($userCount > 0) {
    $errors['email'] = "Email already exists";
  }


  //if no errors, save user to database
  if(count($errors) === 0)
  {
    $pass_1 = password_hash($pass_1, PASSWORD_DEFAULT); //encrypt password before storage
    $sql = "INSERT INTO users(username, email, password) VALUES('$_POST[username]','$_POST[email]','$_POST[pass_1]')";
    mysqli_query($conn,$sql);
    if (mysqli_query($conn,$sql)){
      //login user
      $user_id = $conn->insert_id;
      $_SESSION['id'] = $user_id;
      $_SESSION['username'] = $user_id;
      $_SESSION['email'] = $user_id;


      //set flash Message
      $_SESSION['message']= "You are now logged in!";
      $_SESSION['alert-class']="alert-success";
      header('location:index.php');
      exit();
    }
    else
    {
      $errors['db_error'] = "Database error: failed to register";
    }
  }
}
?>
