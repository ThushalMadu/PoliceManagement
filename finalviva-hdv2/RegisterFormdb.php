<?php
include "../finalviva-hdv2/db.php";

if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $address  = $_POST['address'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $status = "Good";
    $token = $_POST['token'];

    $sub = "Police Department";
    $msg = "You Sucessfully Registered for the System. 
    
    This Your Login Email Address: " . $email . "

    This Your Password :" . $pass . " 
               
    ";
    // if (isset($_GET['token'])) {
    //     $token = $_GET['token'];
    $sqlcom = "SELECT * FROM driver_tbl WHERE pass='" . $token . "' ";
    $resultcom = mysqli_query($conn, $sqlcom);

    if (mysqli_num_rows($resultcom) > 0) {
        $user = mysqli_fetch_assoc($resultcom);
        $querycom = "UPDATE driver_tbl SET `first_name`='" . $first_name . "',`address`='" . $address . "',`pass`='" . $pass . "' WHERE pass='" . $token . "'";

        if (mysqli_query($conn, $querycom)) {
            header('location: http://localhost/PMS');
            mail($email, $sub, $msg);
            exit(0);
        }
    } else {
        echo "User not found!";
    }
    // } else {
    //     echo "No token provided!";
    // }
    mysqli_close($conn);
}
