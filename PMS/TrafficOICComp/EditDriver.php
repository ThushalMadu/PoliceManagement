<?php
include("php/dbconnect.php");
if (!$_SESSION['loggedintraffic']) {
    header("location:login.php");
    die;
} else {
    $errormsg = '';
    $action = "add";

    $first_name = '';
    $address = '';
    $email = '';
    $phone_number = '';
    $nic = '';
    $rate = '';
    $status = '';
    $pass = '';
    $driverLicNo = '';
    if (isset($_POST['save'])) {

        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
        $nic = mysqli_real_escape_string($conn, $_POST['nic']);
        $rate = mysqli_real_escape_string($conn, $_POST['rate']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $rank = mysqli_real_escape_string($conn, $_POST['rank']);
        $pass = mysqli_real_escape_string($conn, $_POST['pass']);

        if ($_POST['action'] == "add") {


            // $sql = $conn->query("INSERT INTO driver_tbl (`first_name`, `pol_station`, `email`, `phone_number`, `rank`, `pass`) VALUES ('$first_name','$pol_station','$email','$phone_number','$rank','$pass')");

            // echo '<script type="text/javascript">window.location="EditDriver.php?act=1";</script>';
        } else 
    if ($_POST['action'] == "update") {
            $driverLicNo = mysqli_real_escape_string($conn, $_POST['driverLicNo']);
            $sql = $conn->query("UPDATE  driver_tbl  SET  `first_name`='" . $first_name . "',`address`='" . $address . "',`nic`='" . $nic . "',`email`='" . $email . "',`phone_number`='" . $phone_number . "',`pass`='" . $pass . "'  WHERE  driverLicNo  = '" . $driverLicNo . "'");
            echo '<script type="text/javascript">window.location="EditDriver.php?act=2";</script>';
        }
    }




    if (isset($_GET['action']) && $_GET['action'] == "delete") {

        $conn->query("DELETE FROM `driver_tbl` WHERE driverLicNo='" . $_GET['driverLicNo'] . "'");
        header("location: EditDriver.php?act=3");
    }


    $action = "add";
    if (isset($_GET['action']) && $_GET['action'] == "edit") {
        $driverLicNo = isset($_GET['driverLicNo']) ? mysqli_real_escape_string($conn, $_GET['driverLicNo']) : '';

        $sqlEdit = $conn->query("SELECT * FROM driver_tbl WHERE driverLicNo='" . $driverLicNo . "'");
        if ($sqlEdit->num_rows) {
            $rowsEdit = $sqlEdit->fetch_assoc();
            extract($rowsEdit);
            $action = "update";
        } else {
            $_GET['action'] = "";
        }
    }


    if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "1") {
        $errormsg = "<div class='alert alert-success'><strong>Success!</strong> Driver Add successfully</div>";
    } else if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "2") {
        $errormsg = "<div class='alert alert-success'><strong>Success!</strong> Driver Update successfully</div>";
    } else if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "3") {
        $errormsg = "<div class='alert alert-success'><strong>Success!</strong> Driver Delete successfully</div>";
    }
}
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

    <script src="js/jquery-1.10.2.js"></script>



</head>
<?php
include("php/header.php");
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Driver Edit

                </h1>

                <?php

                echo $errormsg;
                ?>
            </div>
        </div>



        <?php
        if (isset($_GET['action']) && @$_GET['action'] == "add" || @$_GET['action'] == "edit") {
        ?>

            <script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php echo ($action == "add") ? "Driver Update " : "Driver Update "; ?>
                        </div>
                        <form action="EditDriver.php" method="post" id="signupForm1" class="form-horizontal">
                            <div class="panel-body">




                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Old">First Name </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Old">Driver Licence No</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="driverLicNo" maxlength="8" name="driverLicNo" value="<?php echo $driverLicNo; ?>" />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Password">address</label>
                                    <div class="col-sm-10">
                                        <?php //echo $pol_station; 
                                        ?>
                                        <!-- <input type="text" class="form-control" id="pol_station" name="pol_station" value="" /> -->
                                        <select name="address" id="address" class="form-control">
                                            <option value="<?php echo $address; ?>"><?php echo $address; ?></option>
                                            <?php
                                            // Fetch Department
                                            $sql_poldepartment = "SELECT * FROM branch_tbl";
                                            $poldepartment_data = mysqli_query($conn, $sql_poldepartment);

                                            while ($row = mysqli_fetch_assoc($poldepartment_data)) {

                                                $address = $row['branch_name'];

                                                // Option
                                                echo "<option value='" . $address . "' >" . $address . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Password">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" />
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Password">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="pass" name="pass" value="<?php echo $pass; ?>" />
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Password">Phone Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $phone_number; ?>" />
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Password">NIC</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nic" name="nic" value="<?php echo $nic; ?>" />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <input type="hidden" name="driverLicNo" value="<?php echo $driverLicNo; ?>">
                                        <input type="hidden" name="action" value="<?php echo $action; ?>">

                                        <button type="submit" name="save" class="btn btn-primary">Save </button>
                                    </div>
                                </div>





                            </div>
                        </form>

                    </div>
                </div>


            </div>




            <script type="text/javascript">
                $(document).ready(function() {

                    if ($("#signupForm1").length > 0) {
                        $("#signupForm1").validate({
                            rules: {
                                first_name: {
                                    required: true,
                                    digits: false
                                    // maxlength: 10,
                                },

                                phone_number: {
                                    required: true,
                                    digits: true,
                                    maxlength: 10,
                                },
                                address: {
                                    maxlength: 10,
                                    required: true,
                                },
                                email: {
                                    required: true,
                                    email: true,
                                },
                                nic: {
                                    maxlength: 10,
                                    required: true,
                                    // digits: true,
                                },
                                driverLicNo: {
                                    required: true,
                                    maxlength: 8,
                                    digits: true,
                                },
                                pass: {
                                    required: true,
                                },
                            },
                            messages: {
                                email: {
                                    required: "Please enter Email Address",
                                    email: "Please enter Valid Email Address"
                                },
                                phone_number: {
                                    required: "Please enter Phone Number",
                                    digits: "only Digits is Valid for Phone number",
                                    maxlength: "only valida 10 digits"
                                },
                                driverLicNo: {
                                    required: "Please enter Driver Licence Number",
                                    digits: "only Digits is Valid for Driver Licence Number",
                                    maxlength: "only valida 8 digits"
                                },
                                first_name: {
                                    required: "Please enter First Name",
                                    digits: "Enter First Name only Characters"
                                },
                                address: {
                                    required: "Select Police Station"
                                },
                                nic: {
                                    required: "Enter rank ",
                                    digits: "Enter rank only Characters"
                                },
                                pass: {
                                    required: "Enter Password "
                                }
                            },
                            errorElement: "em",
                            errorPlacement: function(error, element) {
                                // Add the `help-block` class to the error element
                                error.addClass("help-block");

                                // Add `has-feedback` class to the parent div.form-group
                                // in order to add icons to inputs
                                element.parents(".col-sm-10").addClass("has-feedback");

                                if (element.prop("type") === "checkbox") {
                                    error.insertAfter(element.parent("label"));
                                } else {
                                    error.insertAfter(element);
                                }

                                // Add the span element, if doesn't exists, and apply the icon classes to it.
                                if (!element.next("span")[0]) {
                                    $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
                                }
                            },
                            success: function(label, element) {
                                // Add the span element, if doesn't exists, and apply the icon classes to it.
                                if (!$(element).next("span")[0]) {
                                    $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
                                }
                            },
                            highlight: function(element, errorClass, validClass) {
                                $(element).parents(".col-sm-10").addClass("has-error").removeClass("has-success");
                                $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
                            },
                            unhighlight: function(element, errorClass, validClass) {
                                $(element).parents(".col-sm-10").addClass("has-success").removeClass("has-error");
                                $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
                            }
                        });

                    }

                });
            </script>



        <?php
        } else {
        ?>

            <link href="css/datatable/datatable.css" rel="stylesheet" />




            <div class="panel panel-default">
                <div class="panel-heading">
                    Driver Update
                </div>
                <div class="panel-body">
                    <div class="table-sorting table-responsive">

                        <table class="table table-striped table-bordered table-hover" id="tSortable22">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Driver Licence No</th>
                                    <th>Driver Name</th>
                                    <th>Police Station</th>
                                    <th>nic</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "select * from driver_tbl ";
                                $q = $conn->query($sql);
                                $i = 1;
                                while ($r = $q->fetch_assoc()) {
                                    echo '<tr>
                                            <td>' . $i . '</td>
                                            <td>' . $r['driverLicNo'] . '</td>
                                            <td>' . $r['first_name'] . '</td>
                                            <td>' . $r['address'] . '</td>
                                            <td>' . $r['nic'] . '</td>
											<td>
											<a href="EditDriver.php?action=edit&driverLicNo=' . $r['driverLicNo'] . '" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
											
											<a onclick="return confirm(\'Are you sure you want to delete this record\');" href="EditDriver.php?action=delete&driverLicNo=' . $r['driverLicNo'] . '" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a> </td>
                                        </tr>';
                                    $i++;
                                }
                                ?>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script src="js/dataTable/jquery.dataTables.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#tSortable22').dataTable({
                        "bPaginate": true,
                        "bLengthChange": false,
                        "bFilter": true,
                        "bInfo": false,
                        "bAutoWidth": true
                    });

                });
            </script>

        <?php
        }
        ?>



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
<?php
if (isset($_GET["msg"])) {
    $msg = ($_GET["msg"]);
    if ($msg == "already") {
        echo '<script>
        alert("User Already Logged in");
    </script>';
    }
    if ($msg == "alreadyemail") {
        echo '<script>
        alert("User Already Logged in Email");
    </script>';
    }
    if ($msg == "alreadyNic") {
        echo '<script>
        alert("User Already Logged in NIC");
    </script>';
    }
    if ($msg == "invalidemail") {
        echo '<script>
        alert("Invalid Email!");
    </script>';
    }
    if ($msg == "sent") {
        echo '<script>
        alert("Sent!");
    </script>';
    }
}
?>