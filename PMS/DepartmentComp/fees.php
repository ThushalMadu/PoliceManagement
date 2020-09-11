<?php
include("php/dbconnect.php");



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Police Manegment System </title>

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

  <link href="css/ui.css" rel="stylesheet" />
  <link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
  <link href="css/datepicker.css" rel="stylesheet" />
  <link href="css/datatable/datatable.css" rel="stylesheet" />

  <script src="js/jquery-1.10.2.js"></script>
  <script type='text/javascript' src='js/jquery/jquery-ui-1.10.1.custom.min.js'></script>
  <script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>

  <script src="js/dataTable/jquery.dataTables.min.js"></script>



</head>
<?php
include("php/header.php");
?>
<div id="page-wrapper">
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <h1 class="page-head-line">Dashboard

        </h1>

      </div>
    </div>

    <!-------->

    <div id="page-inner">

      <div class="row">

        <div class="col-md-4">
          <div class="main-box mb-dull">
            <a href="Branchdeshbord.php">
              <i class="fa fa-usd fa-5x"></i>
              <h5>Branch Dashboard</h5>
            </a>
          </div>
        </div>


        <div class="col-md-4">
          <div class="main-box mb-red">
            <a href="summerydashboard.php">
              <i class="fa fa-file-text fa-5x"></i>
              <h5>Summery Dashboard</h5>
            </a>
          </div>
        </div>


      </div>
      <!-- /. ROW  -->


    </div>
    <!-- /. PAGE INNER  -->
  </div>
  <!-- Modal -->


  <!--------->


</div>
<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->

<div id="footer-sec">
  Police Manegment System
</div>


<!-- BOOTSTRAP SCRIPTS -->
<script src="js/bootstrap.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="js/custom1.js"></script>


</body>

</html>