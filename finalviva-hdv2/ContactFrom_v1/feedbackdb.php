<?php
include "../ContactFrom_v1/db.php";


if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    // if (!logged_in()) 
    // echo 'asodj';
    $name = $_POST['name'];
    $driverLicNo  = $_POST['driverLicNo'];
    $email = $_POST['email'];
    $sub = $_POST['sub'];
    $msg = $_POST['msg'];
    $status = "Pending";
    //
    //
    //
    //
    $subj = "About Feed Back";
    $msgj = "You Sucessfully Registered for the System";
    $check = "SELECT driverLicNo FROM driver_tbl WHERE driverLicNo = '" . $driverLicNo . "'";
    $rs = mysqli_query($conn, $check);
    $data = mysqli_num_rows($rs);
    if ($data > 0) {
        $sql = "INSERT INTO `feedback`( `name`, `driverLicNo`, `email`, `subject`, `msg`, `status`) VALUES ('$name','$driverLicNo','$email','$sub','$msg','$status')";

        if (mysqli_query($conn, $sql)) {
            header("Location: http://localhost/PMS/");
            // echo "New record created successfully";
            mail($email, $subj, $msgj);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            // header("Location: http://localhost/finalviva-hdv2/ContactFrom_v1");

        }
    } else {
        echo "<script> alert('Not Logged in to the system'); </script>";
    }



    mysqli_close($conn);
} else {
    echo "Error: ";
}
