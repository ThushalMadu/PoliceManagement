<?php
include("php/dbconnect.php");
if (!$_SESSION['loggedintraffic']) {
    header("location:login.php");
    die;
} else {
    $errormsg = '';
    $action = "add";

    $fine_name = '';
    $rate = '';
    $price = '';
    $fine_id = '';
    if (isset($_POST['save'])) {

        $fine_name = mysqli_real_escape_string($conn, $_POST['fine_name']);
        $rate = mysqli_real_escape_string($conn, $_POST['rate']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);

        if ($_POST['action'] == "add") {

            $sql = $conn->query("INSERT INTO fine (fine_name,rate,price) VALUES ('$fine_name','$rate','$price')");

            echo '<script type="text/javascript">window.location="AddFine.php?act=1";</script>';
        } else
  if ($_POST['action'] == "update") {
            $fine_id = mysqli_real_escape_string($conn, $_POST['fine_id']);
            $sql = $conn->query("UPDATE  fine  SET  fine_name  = '" . $fine_name . "', rate  = '" . $rate . "', price  = '" . $price . "'  WHERE  fine_id  = '" . $fine_id . "'");
            echo '<script type="text/javascript">window.location="AddFine.php?act=2";</script>';
        }
    }




    if (isset($_GET['action']) && $_GET['action'] == "delete") {

        $conn->query("DELETE FROM `fine` WHERE fine_id='" . $_GET['fine_id'] . "'");
        header("location: AddFine.php?act=3");
    }


    $action = "add";
    if (isset($_GET['action']) && $_GET['action'] == "edit") {
        $fine_id = isset($_GET['fine_id']) ? mysqli_real_escape_string($conn, $_GET['fine_id']) : '';

        $sqlEdit = $conn->query("SELECT * FROM fine WHERE fine_id='" . $fine_id . "'");
        if ($sqlEdit->num_rows) {
            $rowsEdit = $sqlEdit->fetch_assoc();
            extract($rowsEdit);
            $action = "update";
        } else {
            $_GET['action'] = "";
        }
    }


    if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "1") {
        $errormsg = "<div class='alert alert-success'><strong>Success!</strong> Branch Add successfully</div>";
    } else if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "2") {
        $errormsg = "<div class='alert alert-success'><strong>Success!</strong> Branch Edit successfully</div>";
    } else if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "3") {
        $errormsg = "<div class='alert alert-success'><strong>Success!</strong> Branch Delete successfully</div>";
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
                <h1 class="page-head-line">Fines
                    <?php
                    echo (isset($_GET['action']) && @$_GET['action'] == "add" || @$_GET['action'] == "edit") ?
                        ' <a href="AddFine.php" class="btn btn-primary btn-sm pull-right">Back <i class="glyphicon glyphicon-arrow-right"></i></a>' : '<a href="AddFine.php?action=add" class="btn btn-primary btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Add </a>';
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
                            <?php echo ($action == "add") ? "Add Branch" : "Edit Branch"; ?>
                        </div>
                        <form action="AddFine.php" method="post" id="signupForm1" class="form-horizontal">
                            <div class="panel-body">




                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Old">Fine Name </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="branch" name="fine_name" value="<?php echo $fine_name; ?>" />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Password">rate</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="address" name="rate"><?php echo $rate; ?></textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Confirm"> Fine Price</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="price" id="detail"><?php echo $price; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <input type="hidden" name="fine_id" value="<?php echo $fine_id; ?>">
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
                                branch: "required",
                                address: "required"



                            },
                            messages: {
                                branch: "Please enter branch name",
                                address: "Please enter address"


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
                    Manage Fine
                </div>
                <div class="panel-body">
                    <div class="table-sorting table-responsive">

                        <table class="table table-striped table-bordered table-hover" id="tSortable22">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fine Name</th>
                                    <th>Rate Fine</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "select * from fine ";
                                $q = $conn->query($sql);
                                $i = 1;
                                while ($r = $q->fetch_assoc()) {
                                    echo '<tr>
                                            <td>' . $i . '</td>
                                            <td>' . $r['fine_name'] . '</td>
                                            <td>' . $r['rate'] . '</td>
                                            <td>' . $r['price'] . '</td>
											<td>
											<a href="AddFine.php?action=edit&fine_id=' . $r['fine_id'] . '" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
											
											<a onclick="return confirm(\'Are you sure you want to delete this record\');" href="AddFine.php?action=delete&fine_id=' . $r['fine_id'] . '" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a> </td>
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