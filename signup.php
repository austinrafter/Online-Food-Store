<?php include 'userserver.php';?>
<!DOCTYPE html>
<html>
  <head>
   <title>Account Registration for User with php and MySQL</title>
   <link rel="stylesheet" type="text/css" href="bigstyle.css">

  </head>
  <body>

    <div class="registerheader">
      <h2> Register your account</h2>
    </div>

    <form method="post" action="signup.php">

      <?php if(count($errors) > 0): ?>
        <div class="error">
          <?php foreach ($errors as $error): ?>
            <li> <?php echo $error; ?> </li>
          <?php endforeach ?>
        </div>
      <?php endif ?>

      <div class="register-input">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>" >
      </div>

      <div class="register-input">
        <label>Email</label>
        <input type="text" name="email" value="<?php echo $email; ?>">
      </div>

      <div class="register-input">
        <label>Password</label>
        <input type="password" name="pass_1">
      </div>

      <div class="register-input">
        <label>Confirm Password</label>
        <input type="password" name="pass_2">
      </div>

      <div class="register-input">
        <button type="submit" name="register-btn" value="insert" class="btn">
          Create Account
        </button>
      </div>


       <p> Already have an account?
          <a href="login.php"> Sign in here </a>
       </p>
    </form>



  </body>
</html>
