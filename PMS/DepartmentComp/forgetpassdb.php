<?php
include("php/dbconnect.php");

if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $error .= "<p>Invalid email address please type a valid email address!</p>";
    } else {
        $sel_query = "SELECT * FROM `driver_tbl` WHERE email='" . $email . "'";
        $results = mysqli_query($conn, $sel_query);
        $row = mysqli_num_rows($results);
        if ($row == "") {
            $error .= "<p>No user is registered with this email address!</p>";
        } else {
            while ($rowe = mysqli_fetch_array($results)) {
                $email = $rowe['email'];
                $pass = $rowe['pass'];
                $subrep = 'This Police Departemet Feedback About Resetting Password';
                $repmsg = "This Your Password :  " . $pass . "  :   Please Delete this mail";
                mail($email, $subrep, $repmsg);
                header("Location: http://localhost/PMS/");
                echo '<script>alert("We Sent You a Mail Password")</script>';
            }
        }
    }
} else {
}
