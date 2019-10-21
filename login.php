<?php include 'loginserver.php';?>
<!DOCTYPE html>
<html>
  <head>
   <title>Account login for User with php and MySQL</title>
   <link rel="stylesheet" type="text/css" href="bigstyle.css">

  </head>
  <body>
    <div class="wrapper">
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>

                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>

                <p>Don't have an account? <a href="signup.php">Sign up here.</a>.</p>

            </form>
        </div>

  </body>
</html>
