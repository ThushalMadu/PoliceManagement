<?php
include "../../finalviva-hdv2/db.php";

header("refresh:4;url=DriverHome.php");

if (!$_SESSION['loggedindriver']) {
  header("location:index.php");
  die;
} else {

  if (!isset($_SESSION)) {
    session_start();
  }
  $email = $_SESSION['email'];
  $subfine = "Police Department";
  $msgfine = "You are suspended, we will notifiy you will have to consequence";
  mail($email, $subfine, $msgfine);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>Suspend</title>

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet" />

  <!-- Custom stlylesheet -->
  <link type="text/css" rel="stylesheet" href="errorcss/style.css" />


</head>

<body>
  <div id="notfound">
    <div class="notfound">
      <div class="notfound-404">
        <h1>Suspend</h1>
        <h2>You Have Suspend</h2>
      </div>
      <a href="DriverHome.php">Homepage</a>
    </div>
  </div>
</body>

</html>