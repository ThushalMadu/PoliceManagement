<?php
include("php/dbconnect.php");

// session_start();
if (!$_SESSION['loggedintraffic']) {
    header("location:login.php");
    die;
} else {
    if (!isset($_SESSION)) {
        session_start();
    }
    $officer_id = $_SESSION['username'];
    $query = "SELECT `first_name` FROM trafficoic_tbl WHERE officer_id = '" . $officer_id . "'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $name = $row["first_name"];
    } else {
        echo "No record found";
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
                <h1 class="page-head-line">DASHBOARD</h1>
                <h2 style="text-align:center;"><strong>Welcome Officer <?php echo $name ?></strong> </h2>

            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">

            <div class="col-md-4">
                <div class="main-box mb-pink">
                    <a href="AddOfficer.php">
                        <i class="fa fa-users fa-5x"></i>
                        <h5>Manage Officer</h5>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="main-box mb-inde">
                    <a href="EditDriver.php">
                        <i class="fa fa-bullseye fa-5x"></i>
                        <h5>Manage Driver</h5>
                    </a>
                </div>
            </div>



            <div class="col-md-4">
                <div class="main-box mb-dull">
                    <a href="ViewFeedback.php">
                        <i class="fa fa-check-square fa-5x"></i>
                        <h5>View FeedBack</h5>
                    </a>
                </div>
            </div>
            <br />

            <div class="col-md-4">
                <div class="main-box mb-dull">
                    <a href="ViewSpotFine.php">
                        <i class="fa fa-ellipsis-h fa-5x"></i>
                        <h5>View Spot Fine</h5>
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