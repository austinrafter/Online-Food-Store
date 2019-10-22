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
    $password = $_POST['password'];
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

  if(empty($password)){
    $errors['pass_1'] = "Password required";
  }

  if($password !== $pass_2){
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
    $hashpassword = password_hash($password, PASSWORD_DEFAULT); //encrypt password before storage
    $sql = "INSERT INTO users(username, email, password) VALUES('$_POST[username]','$_POST[email]','$hashpassword')";
    $query = mysqli_query($conn,$sql);
    if ($query){
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

// Check if the user is already logged in, if yes then redirect them to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

//require_once 'config.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
          // Set parameters
          $param_username = $username;

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashpassword);
                    if(mysqli_stmt_fetch($stmt)){
                      //$temphashedpass = password_hash($password, PASSWORD_DEFAULT);
                        if(password_verify($password, $hashpassword)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $user_id;
                            $_SESSION["username"] = $user_id;

                            // Redirect user to welcome page with flash messages
                            $_SESSION['message']= "You are now logged in!";
                            $_SESSION['alert-class']="alert-success";
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($conn);
}
?>
