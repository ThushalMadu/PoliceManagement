<?php
include("php/dbconnect.php");
if (!$_SESSION['loggedintraffic']) {
    header("location:login.php");
    die;
} else {
    $errormsg = '';
    $action = "add";

    $first_name = '';
    $pol_station = '';
    $email = '';
    $phone_number = '';
    $rank = '';
    $pass = '';
    $officer_id = '';
    if (isset($_POST['save'])) {

        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $pol_station = mysqli_real_escape_string($conn, $_POST['pol_station']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
        $rank = mysqli_real_escape_string($conn, $_POST['rank']);
        $pass = mysqli_real_escape_string($conn, $_POST['pass']);

        if ($_POST['action'] == "add") {

            $sql_u = "SELECT * FROM `officer_tbl` WHERE email = '" . $email . "'";
            $res_u = mysqli_query($conn, $sql_u);
            $sql_phn = "SELECT * FROM `officer_tbl` WHERE phone_number = '" . $phone_number . "'";
            $res_phn = mysqli_query($conn, $sql_phn);

            if (mysqli_num_rows($res_u) > 0) {
                // header("Location: http://localhost/PMS/DepartmentComp/AddOfficer.php?msg=already");
                $errormsg = '<div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> User Already login 
              </div>';
            } else if (mysqli_num_rows($res_phn) > 0) {
                // header("Location: http://localhost/PMS/DepartmentComp/AddOfficer.php?msg=already");
                $errormsg = '<div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> User Already login 
              </div>';
            } else {
                $sql = $conn->query("INSERT INTO officer_tbl (`first_name`, `pol_station`, `email`, `phone_number`, `rank`, `pass`) VALUES ('$first_name','$pol_station','$email','$phone_number','$rank','$pass')");

                echo '<script type="text/javascript">window.location="AddOfficer.php?act=1";</script>';
            }
        } else
  if ($_POST['action'] == "update") {
            $officer_id = mysqli_real_escape_string($conn, $_POST['officer_id']);
            $sql = $conn->query("UPDATE  officer_tbl  SET  `first_name`='" . $first_name . "',`pol_station`='" . $pol_station . "',`email`='" . $email . "',`phone_number`='" . $phone_number . "',`rank`='" . $rank . "',`pass`='" . $pass . "'  WHERE  officer_id  = '" . $officer_id . "'");
            echo '<script type="text/javascript">window.location="AddOfficer.php?act=2";</script>';
        }
    }




    if (isset($_GET['action']) && $_GET['action'] == "delete") {

        $conn->query("DELETE FROM `officer_tbl` WHERE officer_id='" . $_GET['officer_id'] . "'");
        header("location: AddOfficer.php?act=3");
    }


    $action = "add";
    if (isset($_GET['action']) && $_GET['action'] == "edit") {
        $officer_id = isset($_GET['officer_id']) ? mysqli_real_escape_string($conn, $_GET['officer_id']) : '';

        $sqlEdit = $conn->query("SELECT * FROM officer_tbl WHERE officer_id='" . $officer_id . "'");
        if ($sqlEdit->num_rows) {
            $rowsEdit = $sqlEdit->fetch_assoc();
            extract($rowsEdit);
            $action = "update";
        } else {
            $_GET['action'] = "";
        }
    }


    if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "1") {
        $errormsg = "<div class='alert alert-success'><strong>Success!</strong> Officer Add successfully</div>";
    } else if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "2") {
        $errormsg = "<div class='alert alert-success'><strong>Success!</strong> Officer Edit successfully</div>";
    } else if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "3") {
        $errormsg = "<div class='alert alert-success'><strong>Success!</strong> Officer Delete successfully</div>";
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
                <h1 class="page-head-line">Officer Traffic
                    <?php
                    echo (isset($_GET['action']) && @$_GET['action'] == "add" || @$_GET['action'] == "edit") ?
                        ' <a href="AddOfficer.php" class="btn btn-primary btn-sm pull-right">Back <i class="glyphicon glyphicon-arrow-right"></i></a>' : '<a href="AddOfficer.php?action=add" class="btn btn-primary btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Add </a>';
                    ?>
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
                            <?php echo ($action == "add") ? "Add Officer " : "Edit Officer "; ?>
                        </div>
                        <form action="AddOfficer.php" method="post" id="signupForm1" class="form-horizontal">
                            <div class="panel-body">




                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Old">First Name </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>" />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Password">Police Station</label>
                                    <div class="col-sm-10">
                                        <?php //echo $pol_station; 
                                        ?>
                                        <!-- <input type="text" class="form-control" id="pol_station" name="pol_station" value="" /> -->
                                        <select name="pol_station" id="pol_station" class="form-control">
                                            <option value="<?php echo $pol_station; ?>"><?php echo $pol_station; ?></option>
                                            <?php
                                            // Fetch Department
                                            $sql_poldepartment = "SELECT * FROM branch_tbl";
                                            $poldepartment_data = mysqli_query($conn, $sql_poldepartment);

                                            while ($row = mysqli_fetch_assoc($poldepartment_data)) {

                                                $pol_station = $row['branch_name'];

                                                // Option
                                                echo "<option value='" . $pol_station . "' >" . $pol_station . "</option>";
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
                                    <label class="col-sm-2 control-label" for="Password">rank</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="rank" name="rank" value="<?php echo $rank; ?>" />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <input type="hidden" name="officer_id" value="<?php echo $officer_id; ?>">
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
                                pol_station: {
                                    required: true,
                                },
                                email: {
                                    required: true,
                                    email: true,
                                },
                                rank: {
                                    required: true,
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

                                first_name: {
                                    required: "Please enter First Name",
                                    digits: "Enter First Name only Characters"
                                },
                                pol_station: {
                                    required: "Select Police Station"
                                },
                                rank: {
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
                    Manage Traffic Officer
                </div>
                <div class="panel-body">
                    <div class="table-sorting table-responsive">

                        <table class="table table-striped table-bordered table-hover" id="tSortable22">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Officer ID</th>
                                    <th>Traffic OIC Name</th>
                                    <th>Police Station</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "select * from officer_tbl ";
                                $q = $conn->query($sql);
                                $i = 1;
                                while ($r = $q->fetch_assoc()) {
                                    echo '<tr>
                                            <td>' . $i . '</td>
                                            <td>' . $r['officer_id'] . '</td>
                                            <td>' . $r['first_name'] . '</td>
                                            <td>' . $r['pol_station'] . '</td>
											<td>
											<a href="AddOfficer.php?action=edit&officer_id=' . $r['officer_id'] . '" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
											
											<a onclick="return confirm(\'Are you sure you want to delete this record\');" href="AddOfficer.php?action=delete&officer_id=' . $r['officer_id'] . '" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a> </td>
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