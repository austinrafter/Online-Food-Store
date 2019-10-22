<?php include ('userserver.php');?>
<?php include ('loginserver.php');?>
<!DOCTYPE html>
<html>
  <head>
   <title>Homepage</title>
   <link rel="stylesheet" type="text/css" href="bigstyle.css">

  </head>
  <body>

    <div class="registerheader">
      <h2> Youre logged in.</h2>
    </div>

    <?php if(isset($_SESSION['message'])): ?>
    <div class="alert <?php echo $_SESSION['alert-class']; ?>">
      <?php echo $_SESSION['message'];
            unset ($_SESSION['message']);
            unset ($_SESSION['alert-class']);
          ?>
    </div>
  <?php endif; ?>


    <a href="foodgroups.html">Start Order Here</a>
    <a href="logout.php" class="logout"> Logout </a>



  </body>
</html>
