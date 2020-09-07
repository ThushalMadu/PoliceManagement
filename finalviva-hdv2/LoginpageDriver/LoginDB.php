<?php
include "../../finalviva-hdv2/db.php";

session_start();

$email = $_POST['email'];
$pass = $_POST['pass'];

$sql = 'SELECT * FROM `driver_tbl` WHERE email="' . $email . '" AND pass ="' . $pass . '"';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $_SESSION["email"] = $email;
    $_SESSION['loggedindriver'] = true;

    $checksus = "SELECT * FROM `driver_tbl` WHERE `status`= 'Suspend' AND email = '" . $email . "'";
    $rssus = mysqli_query($conn, $checksus);
    $datasus = mysqli_num_rows($rssus);
    if ($datasus > 0) {
        header("Location: http://localhost/finalviva-hdv2/LoginpageDriver/error.php");
    } else {
        header("Location: http://localhost/finalviva-hdv2/LoginpageDriver/DriverHome.php");
    }
} else {
    header("Location: http://localhost/finalviva-hdv2/LoginpageDriver/index.php?msg=empty");
}
mysqli_close($conn);
