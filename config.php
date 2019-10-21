<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'registration');

//access database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_select_db($conn,'registration');

if(!$conn)
{
  echo "could  not connect ";
}

?>
