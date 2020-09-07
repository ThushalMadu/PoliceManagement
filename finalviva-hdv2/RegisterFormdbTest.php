<?php
include "../finalviva-hdv2/db.php";
if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    // if (!logged_in()) 
    // echo 'asodj';
    $first_name = "waiting";
    $driverLicNo  = $_POST['driverLicNo'];
    $address  = "waiting";
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $nic = $_POST['nic'];
    $random = substr(md5(mt_rand()), 0, 7);
    // $pass = $_POST['pass'];
    $status = "Good";
    $sub = "Police Department";


    $sql = "INSERT INTO `driver_tbl`( `first_name`, `driverLicNo`, `address`, `email`, `phone_number`,`nic`,`pass`, `status`) VALUES ('$first_name','$driverLicNo','$address','$email','$phone_number','$nic','$random','$status')";
    $sql_u = "SELECT * FROM `driver_tbl` WHERE driverLicNo = '" . $driverLicNo . "'";
    $sql_nic = "SELECT * FROM `driver_tbl` WHERE nic = '" . $nic . "'";
    $sql_email = "SELECT * FROM `driver_tbl` WHERE email = '" . $email . "'";


    $msg = "You Sucessfully Registered for the System. 
    
    Please Click on the link here: <a href=http://localhost/finalviva-hdv2/RegisterForm.php?token=" . $random . " title='Verify Email!'>Verify Email!</a>
    
    ";
    // $msg = "You Sucessfully Registered for the System. 

    // '<a href=\"http://localhost/finalviva-hdv2/RegisterForm.php?token=" . $random . "\">Verify Email!</a>'

    // ";
    $res_u = mysqli_query($conn, $sql_u);
    $res_nic = mysqli_query($conn, $sql_nic);
    $res_email = mysqli_query($conn, $sql_email);

    if (mysqli_num_rows($res_u) > 0) {
        header("Location: http://localhost/finalviva-hdv2/RegisterFormQuick.php?msg=already");
    } else if (mysqli_num_rows($res_nic) > 0) {
        header("Location: http://localhost/finalviva-hdv2/RegisterFormQuick.php?msg=alreadyNic");
    }
    else if (mysqli_num_rows($res_email) > 0) {
        header("Location: http://localhost/finalviva-hdv2/RegisterFormQuick.php?msg=alreadyemail");
    }
    else {
        if (mysqli_query($conn, $sql)) {
            header("Location: http://localhost/PMS/LoginPageOfficer/branch.php");
            // echo "New record created successfully";
            mail($email, $sub, $msg);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
