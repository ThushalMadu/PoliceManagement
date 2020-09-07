<?php
$username = $_POST['username']; //username
$password = $_POST['password']; //password 
session_start();

$con = mysqli_connect("localhost", "root", "", "policedep"); //mysqli("localhost","username of database","password of database","database name")
$result = mysqli_query($con, "SELECT * FROM `trafficoic_tbl` WHERE `officer_id`='$username' && `pass`='$password'");
$count = mysqli_num_rows($result);
if ($count == 1) {
	$_SESSION["username"] = $username;
	$_SESSION['loggedintraffic'] = true;
	header("location:index.php");
} else {
	header("location: Login.php?msg=empty");
}
