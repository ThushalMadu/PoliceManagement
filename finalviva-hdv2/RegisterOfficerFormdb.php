<?php
include "../finalviva-hdv2/db.php";
if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    // if (!logged_in()) 
    // echo 'asodj';
    $first_name = $_POST['first_name'];
    $officer_id  = $_POST['officer_id'];
    $pol_station  = $_POST['pol_station'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $rank = $_POST['rank'];
    $pass = $_POST['pass'];
    $sub = "Police Department";
    $msg = "You Sucessfully Registered for the System";
    if (!empty($_POST['pol_station'])) {
        $sql = "INSERT INTO `officer_tbl`(`first_name`, `officer_id`, `pol_station`, `email`, `phone_number`, `rank`, `pass`) VALUES ('$first_name','$officer_id','$pol_station','$email','$phone_number','$rank','$pass')";

        if (mysqli_query($conn, $sql)) {
            header("Location: http://localhost/PMS/");
            // echo "New record created successfully";
            mail($email, $sub, $msg);
        } else {

            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
