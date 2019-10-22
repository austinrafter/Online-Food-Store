<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

if(session_destroy())
{
  header("Location: frontpage.html");//redirecting to front page
}

 ?>
