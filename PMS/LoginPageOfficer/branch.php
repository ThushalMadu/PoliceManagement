<?php
include("php/dbconnect.php");
date_default_timezone_set('Asia/Colombo');
if (!$_SESSION['loggedinofficer']) {
	header("location:login.php");
	die;
} else {
	if (!isset($_SESSION)) {
		session_start();
	}
	$user = $_SESSION['username'];
	// Echo session variables that were set on previous page
	// echo "This is " . $_SESSION["username"] . ".";
	$email = $_SESSION['username'];
	$query = "SELECT officer_id FROM officer_tbl WHERE email = '" . $email . "'";
	$result = mysqli_query($conn, $query);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		$officer_id = $row["officer_id"];
	} else {
		echo "No record found";
	}


	$errormsg = '';
	$action = "add";

	$expire_date = date("Y-m-d", strtotime(' + 30 days'));
	$date =  date('Y-m-d H:i');


	$branch = '';
	$address = '';
	$detail = '';
	$id = '';
	if (isset($_POST['save'])) {

		$driverLicNo = $_POST['driverLicNo'];
		$vehicle_No  = $_POST['vehicle_No'];
		$fine_cate  = $_POST['fine_cate'];
		// $date =  date('Y-m-d H:i');
		// mysqli_real_escape_string($conn, $_POST['expire_date']);
		// mysqli_real_escape_string($conn, $_POST['date']);
		// $expire_date = date("Y-m-d", strtotime(' + 30 days'));
		// $rate = $_POST['rate'];
		$statuspay = 'pending';
		$complain = $_POST['complain'];
		$pol_station = $_POST['pol_station'];
		// $status = $_POST['status'];
		// $officer_id = $_POST['officer_id'];




		$sql1 = "SELECT * FROM fine WHERE fine_name = '" . $fine_cate . "'";
		$result = mysqli_query($conn, $sql1);
		while ($row = mysqli_fetch_array($result)) {

			$rate2 = $row['rate'];
		}



		if (($_POST['action'] == "add") && !empty($_POST['fine_cate'])) {

			$check = "SELECT driverLicNo FROM driver_tbl WHERE driverLicNo = '" . $driverLicNo . "'";
			$rs = mysqli_query($conn, $check);
			$data = mysqli_num_rows($rs);
			if ($data > 0) {
				$checksus = "SELECT driverLicNo FROM driver_tbl WHERE status = 'Suspend' AND driverLicNo = '" . $driverLicNo . "' ";
				$rssus = mysqli_query($conn, $checksus);
				$datasus = mysqli_num_rows($rssus);
				if ($datasus > 0) {


					$sql = "INSERT INTO `spot_fine_tbl`(`driverLicNo`, `vehicle_No`, `fine_cate`, `date`, `expire_date`, `rate`, `complain`, `pol_station`, `statuspay`, `officer_id`) VALUES ('$driverLicNo','$vehicle_No','$fine_cate','$date','$expire_date','$rate2','$complain','$pol_station','$statuspay','$officer_id')";
					$sql2 = "SELECT email FROM driver_tbl WHERE driverLicNo = '" . $driverLicNo . "'";
					$subfine = "Police Department";
					$msgfine = "You Have Fine: '$fine_cate'. Expired Date: '$expire_date' . The Police officer will get your suspended driver licence. we will get you know letter when will be the consequence";
					$result2 = mysqli_query($conn, $sql2);
					while ($rowe = mysqli_fetch_array($result2)) {
						$emaildr = $rowe['email'];
					}
					if (mysqli_query($conn, $sql)) {
						// header("Location: http://localhost/PMS/");
						$errormsg = '<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Error!</strong> Spot Fine successfully added, Driver Already Suspended if Driver Had Licence Please Get
					  </div>';
						mail($emaildr, $subfine, $msgfine);
						// echo "New record created successfully";
					} else {

						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
				} else {
					$sqlupdaterate = "UPDATE driver_tbl SET rate = rate + $rate2 WHERE driverLicNo = '" . $driverLicNo . "'";
					mysqli_query($conn, $sqlupdaterate);
					$sql = "INSERT INTO `spot_fine_tbl`(`driverLicNo`, `vehicle_No`, `fine_cate`, `date`, `expire_date`, `rate`, `complain`, `pol_station`, `statuspay`, `officer_id`) VALUES ('$driverLicNo','$vehicle_No','$fine_cate','$date','$expire_date','$rate2','$complain','$pol_station','$statuspay','$officer_id')";
					$sql2 = "SELECT email FROM driver_tbl WHERE driverLicNo = '" . $driverLicNo . "'";
					$subfine = "Police Department";
					$msgfine = "You Have Fine: '$fine_cate'. Expired Date: '$expire_date' ";
					$result2 = mysqli_query($conn, $sql2);
					while ($rowe = mysqli_fetch_array($result2)) {
						$emaildr = $rowe['email'];
					}
					if (mysqli_query($conn, $sql)) {
						// header("Location: http://localhost/PMS/");
						$errormsg = "<div class='alert alert-success'><strong>Success!</strong> Spot Fine Add successfully</div>";
						mail($emaildr, $subfine, $msgfine);
						// echo "New record created successfully";
					} else {

						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
				}
			} else {
				$errormsg = '<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> Driver Not Registered to the system
			  </div>';
			}
			// echo '<script type="text/javascript">window.location="branch.php?act=1";</script>';
		}
		// 	else
		//   if ($_POST['action'] == "update") {
		// 		$id = mysqli_real_escape_string($conn, $_POST['id']);
		// 		$sql = $conn->query("UPDATE  branch  SET  branch  = '$branch', address  = '$address', detail  = '$detail'  WHERE  id  = '$id'");
		// 		echo '<script type="text/javascript">window.location="branch.php?act=2";</script>';
		// 	}
	}




	if (isset($_GET['action']) && $_GET['action'] == "delete") {

		$conn->query("UPDATE  branch set delete_status = '1'  WHERE id='" . $_GET['id'] . "'");
		header("location: branch.php?act=3");
	}


	$action = "add";
	if (isset($_GET['action']) && $_GET['action'] == "edit") {
		$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

		$sqlEdit = $conn->query("SELECT * FROM branch WHERE id='" . $id . "'");
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
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
		function showUser(str) {
			if (str == "") {
				document.getElementById("txtHint").innerHTML = "";
				return;
			} else {
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint").innerHTML = this.responseText;

					}
				};
				xmlhttp.open("GET", "getrate.php?q=" + str, true);
				xmlhttp.send();
			}
			// document.getElementById("txtHint").value = str;

		}
	</script>


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
				<h1 class="page-head-line">Isse Spot Fine

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
							<?php echo ($action == "add") ? "Add Driver" : "Edit Branch"; ?>
						</div>
						<form action="branch.php" method="post" id="signupForm1" class="form-horizontal">
							<div class="panel-body">

								<div class="form-group">
									<label class="col-sm-2 control-label" for="Password">Driver Licence No </label>
									<div class="col-sm-10">
										<input type="text" class="form-control" maxlength="8" id="driverLicNo" name="driverLicNo" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label" for="Confirm"> Vehicle No</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="vehicle_No" name="vehicle_No" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="Confirm"> Police ID</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="officer_id" name="officer_id" value="<?php echo $officer_id; ?>" disabled />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="Confirm">Fine Category</label>
									<div class="col-sm-10">
										<select name="fine_cate" id="fine_cate" class="form-control">
											<option value="">Select a fine:</option>
											<?php
											// Fetch Department
											$sql_department = "SELECT * FROM fine";
											$department_data = mysqli_query($conn, $sql_department);

											while ($row = mysqli_fetch_assoc($department_data)) {

												$fine_name = $row['fine_name'];

												// Option
												echo "<option value='" . $fine_name . "' >" . $fine_name . "</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="Confirm">Police Station</label>
									<div class="col-sm-10">
										<!-- <input type="text" class="form-control" id="pol_station" name="pol_station" /> -->
										<select name="pol_station" id="pol_station" class="form-control">
											<option value="">Select a Police Station:</option>
											<?php
											// Fetch Department
											$sql_poldepartment = "SELECT * FROM branch_tbl";
											$poldepartment_data = mysqli_query($conn, $sql_poldepartment);

											while ($row = mysqli_fetch_assoc($poldepartment_data)) {

												$branch_name = $row['branch_name'];

												// Option
												echo "<option value='" . $branch_name . "' >" . $branch_name . "</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="Confirm"> Complain about fine</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="complain" name="complain" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="Confirm"> Date</label>
									<div class="col-sm-10">
										<input name="date" id="branch" value="<?php echo $date; ?>" disabled>
										<!-- <p><span id="datetime"></span></p> -->
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="Confirm">Expire Date</label>
									<div class="col-sm-10">
										<input name="expire_date" id="branch" value="<?php echo $expire_date; ?>" disabled>
										<!-- <p><span id="datetime"></span></p> -->
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-8 col-sm-offset-2">
										<input type="hidden" name="id" value="<?php echo $id; ?>">
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
				$("#startDate").val(new Date().toJSON().slice(0, 19));
			</script>
			<script type="text/javascript">
				$(document).ready(function() {



					if ($("#signupForm1").length > 0) {
						$("#signupForm1").validate({
							rules: {

								driverLicNo: {
									required: true,
									maxlength: 8,
								},
								vehicle_No: {
									required: true,
									maxlength: 8,
									pattern: "^[A-Za-z]{2,3}(-\d{2}(-[A-Za-z]{1,2})?)?-\d{3,4}$",
								},
								fine_cate: {
									required: true,
								},
								pol_station: {
									required: true,
								},
								complain: {
									required: true,
								}
							},
							messages: {
								branch: "Please enter branch digit and 5 is maximum",
								vehicle_No: "Please enter Vehicle No or write valid one",
								driverLicNo: "Enter Driver Licence",
								pol_station: "Select Police Station",
								complain: "Enter Complain Yes or No"
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


			<!-- http://localhost/finalviva-hdv2/RegisterForm.php -->
			<div class="rowbran">
				<div class="col-md-4">
					<div class="main-box mb-pink">
						<a href="branch.php?action=add">
							<i class="fa fa-users fa-5x"></i>
							<h5>Isse Spot Fine</h5>
						</a>
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
		<!-- <script>
			jQuery(function() {
				$(".vehicle_No").keyup(function() {
					var VAL = this.value;

					var vehicle_No = new RegExp('^[A-Za-z]{2,3}(-\d{2}(-[A-Za-z]{1,2})?)?-\d{3,4}$');

					if (vehicle_No.test(VAL)) {
						// alert('Great, you entered an E-Mail-address');
					}
				});
			});
		</script> -->


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