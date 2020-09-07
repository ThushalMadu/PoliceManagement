<?php
$username = $_POST['username']; //username
$password = $_POST['password']; //password 
session_start();

$con = mysqli_connect("localhost", "root", "", "policedep"); //mysqli("localhost","username of database","password of database","database name")
$result = mysqli_query($con, "SELECT * FROM `depart_user` WHERE `officer_id`='$username' && `pass`='$password'");
$count = mysqli_num_rows($result);
if ($count == 1) {
	$_SESSION["username"] = $username;
	$_SESSION['loggedin'] = true;
	header("location:index.php");
} else {
	header("Location: http://localhost/PMS/DepartmentComp/login.php?msg=empty");
}
