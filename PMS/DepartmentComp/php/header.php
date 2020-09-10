<?php
// include("dbconnect.php");

// session_start();
if (!$_SESSION['loggedin']) {
    header("location:login.php");
    die;
} else {
    if (!isset($_SESSION)) {
        session_start();
    }
    $officer_id = $_SESSION['username'];
    $query = "SELECT `name` FROM depart_user WHERE officer_id = '" . $officer_id . "'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $name = $row["name"];
    } else {
        echo "No record found";
    }
}
?>


<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Police Manegment System</a>
            </div>

        </nav>
        <!-- /. NAV TOP  -->

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <img src="img/user.png" class="img-thumbnail" />
                            <div class="inner-text">
                                <?php echo $name ?>
                            </div>
                        </div>

                    </li>


                    <li>
                        <a class="active-menu" href="index.php"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>

                    <li>
                        <a href="AddTrafficOic.php"><i class="fa fa-university "></i>Add Traffic OIC</a>
                    </li>

                    <li>
                        <a href="AddFine.php"><i class="fa fa-users "></i>Add Fine</a>
                    </li>
                    <li>
                        <a href="ReCorrectDriver.php"><i class="fa fa-users "></i>Suspend Drivers</a>
                    </li>
                    <li>
                        <a href="ViewSpotFine.php"><i class="fa fa-users "></i>View Spot Fine</a>
                    </li>
                    <li>
                        <a href="ViewFeedback.php"><i class="fa fa-usd "></i>View FeedBacks</a>
                    </li>
                    <li>
                        <a href="fees.php"><i class="fa fa-usd "></i>Report Dashboard</a>
                    </li>
                    <li>
                        <a href="reportmain.php"><i class="fa fa-usd "></i>Report</a>
                    </li>
                    <li>
                        <a href="setting.php"><i class="fa fa-cogs "></i>Setting</a>
                    </li>

                    <li>
                        <a href="http://localhost/PMS"><i class="fa fa-power-off "></i>Logout</a>
                    </li>


                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->