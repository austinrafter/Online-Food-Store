<?php include 'userserver.php'; ?>
<!DOCTYPE html>
<html>
  <head>
   <title>Forgot Password Page</title>
   <link rel="stylesheet" type="text/css" href="bigstyle.css">

  </head>
  <body>
    <div class="wrapper">
            <h2>Password Recovery</h2>
            <p>Please enter the email address you used to sign up to this site
              and we will email you the steps to recover your password. </p>

            <form action="forgot_password.php" method="post">
              <?php if(count($errors) > 0): ?>
                <div class="error">
                  <?php foreach ($errors as $error): ?>
                    <li> <?php echo $error; ?> </li>
                  <?php endforeach ?>
                </div>
              <?php endif ?>

              <div class="register-input">
                <label>Email</label>
                <input type="email" name="email">
              </div>


                <div class="register-input">
                  <button type="button" name="forgot_password_btn"value="insert">
                    Email the reset instructions
                  </button>
                </div>

                <p>Don't have an account? <a href="signup.php">Sign up here.</a>.</p>

            </form>
        </div>

  </body>
</html>
