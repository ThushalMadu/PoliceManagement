<?php
include("php/dbconnect.php");
if (!$_SESSION['loggedinofficer']) {
    header("location:login.php");
    die;
} else {
    if (!isset($_SESSION)) {
        session_start();
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Spot Fines Payment System</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!--CUSTOM BASIC STYLES-->
    <link href="css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />


</head>
<?php
include("php/header.php");
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line"><?php
                                            $con = mysqli_connect("localhost", "root", "", "policedep"); //mysqli("localhost","username of database","password of database","database name")

                                            // Echo session variables that were set on previous page
                                            // echo "This is " . $_SESSION["username"] . ".";
                                            $email = $_SESSION['username'];
                                            $query = "SELECT first_name FROM officer_tbl WHERE email = '" . $email . "'";
                                            $result = mysqli_query($con, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                $row = mysqli_fetch_array($result);
                                                $first_name = $row["first_name"];
                                                echo $first_name;
                                            } else {
                                                echo "No record found";
                                            }

                                            ?> </h1>
                <h2 style="text-align:center;"><strong>Welcome Officer</strong> </h2>

            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">

            <div class="col-md-4">
                <div class="main-box mb-pink">
                    <a href="http://localhost/finalviva-hdv2/RegisterFormQuick.php">
                        <i class="fa fa-users fa-5x"></i>
                        <h5>ADD DRIVER</h5>
                    </a>
                </div>
            </div>
            <div class="col-md-2" id="padding-top: 5px;
padding-bottom: 5px;
padding-left: 5px;
padding-right: 5px;">

            </div>

            <div class="col-md-4">
                <div class="main-box mb-red">
                    <a href="http://localhost/PMS/LoginPageOfficer/branch.php?action=add">
                        <i class="fa fa-file-text fa-5x"></i>
                        <h5>Issue Spot fine</h5>
                    </a>
                </div>
            </div>


        </div>
        <!-- /. ROW  -->


    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->

<div id="footer-sec">
    Police Manegment System
</div>

<script src="js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="js/bootstrap.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="js/custom1.js"></script>



</body>

</html>