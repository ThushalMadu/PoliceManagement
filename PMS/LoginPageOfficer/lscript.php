<?php
$username = $_POST['username']; //username
$password = $_POST['password']; //password 
session_start();

$con = mysqli_connect("localhost", "root", "", "policedep"); //mysqli("localhost","username of database","password of database","database name")
$result = mysqli_query($con, "SELECT * FROM `officer_tbl` WHERE `email`='$username' && `pass`='$password'");
$count = mysqli_num_rows($result);
if ($count == 1) {
	$_SESSION["username"] = $username;
	$_SESSION['loggedinofficer'] = true;
	header("location:index.php");
} else {
	header("Location: http://localhost/PMS/LoginPageOfficer/login.php?msg=empty");
}
