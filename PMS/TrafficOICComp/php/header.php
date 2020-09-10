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
                        <!-- <div class="user-img-div">
                            <img src="img/user.png" class="img-thumbnail" />

                            <div class="inner-text">
                                <?php echo $_SESSION['rainbow_name']; ?>
                            <br />
                               
                            </div>
                        </div> -->

                    </li>


                    <li>
                        <a class="active-menu" href="index.php"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="AddOfficer.php"><i class="fa fa-dashboard "></i>Add Traffic Officer</a>
                    </li>
                    <li>
                        <a href="EditDriver.php"><i class="fa fa-university "></i>Manage Driver</a>
                    </li>
                    <li>
                        <a href="ViewSpotFine.php"><i class="fa fa-university "></i>View Spot Fine</a>
                    </li>
                    <li>
                        <a href="ViewFeedback.php"><i class="fa fa-users "></i>View Feedback</a>
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