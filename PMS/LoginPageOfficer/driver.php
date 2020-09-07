<?php
include("php/dbconnect.php");

$errormsg = '';
$action = "add";

$id = "";
$emailid = '';
$sname = '';
$joindate = '';
$remark = '';
$l_number = '';
$contact = '';
$balance = 0;
$fees = '';
$about = '';
$branch = '';


if (isset($_POST['save'])) {

	$sname = mysqli_real_escape_string($conn, $_POST['sname']);
	$joindate = mysqli_real_escape_string($conn, $_POST['joindate']);
	$l_number = mysqli_real_escape_string($conn, $_POST['l_number']);
	$contact = mysqli_real_escape_string($conn, $_POST['contact']);
	$about = mysqli_real_escape_string($conn, $_POST['about']);
	$emailid = mysqli_real_escape_string($conn, $_POST['emailid']);
	$branch = mysqli_real_escape_string($conn, $_POST['branch']);


	if ($_POST['action'] == "add") {
		$remark = mysqli_real_escape_string($conn, $_POST['remark']);
		$fees = mysqli_real_escape_string($conn, $_POST['fees']);
		$advancefees = mysqli_real_escape_string($conn, $_POST['advancefees']);
		$balance = $fees - $advancefees;

		$q1 = $conn->query("INSERT INTO driver (sname,joindate,l_number,contact,about,emailid,branch,balance,fees) VALUES ('$sname','$joindate','$l_number','$contact','$about','$emailid','$branch','$balance','$fees')");

		$sid = $conn->insert_id;

		$conn->query("INSERT INTO  fees_transaction (stdid,paid,submitdate,transcation_remark) VALUES ('$sid','$advancefees','$joindate','$remark')");

		echo '<script type="text/javascript">window.location="driver.php?act=1";</script>';
	} else
  if ($_POST['action'] == "update") {
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$sql = $conn->query("UPDATE  driver  SET  branch  = '$branch', address  = '$address', detail  = '$detail'  WHERE  id  = '$id'");
		echo '<script type="text/javascript">window.location="driver.php?act=2";</script>';
	}
}




if (isset($_GET['action']) && $_GET['action'] == "delete") {

	$conn->query("UPDATE  driver set delete_status = '1'  WHERE id='" . $_GET['id'] . "'");
	header("location: driver.php?act=3");
}


$action = "add";
if (isset($_GET['action']) && $_GET['action'] == "edit") {
	$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

	$sqlEdit = $conn->query("SELECT * FROM driver WHERE id='" . $id . "'");
	if ($sqlEdit->num_rows) {
		$rowsEdit = $sqlEdit->fetch_assoc();
		extract($rowsEdit);
		$action = "update";
	} else {
		$_GET['action'] = "";
	}
}


if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "1") {
	$errormsg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Driver Add successfully</div>";
} else if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "2") {
	$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Success!</strong> Driver Edit successfully</div>";
} else if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "3") {
	$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Driver Delete successfully</div>";
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

	<link href="css/ui.css" rel="stylesheet" />
	<link href="css/datepicker.css" rel="stylesheet" />

	<script src="js/jquery-1.10.2.js"></script>

	<script type='text/javascript' src='js/jquery/jquery-ui-1.10.1.custom.min.js'></script>


</head>
<?php
include("php/header.php");
?>
<div id="page-wrapper">
	<div id="page-inner">
		<div class="row">
			<div class="col-md-12">
				<h1 class="page-head-line">Add Driver

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

				<div class="col-sm-10 col-sm-offset-1">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<?php echo ($action == "add") ? "Issue Spot Fine" : "Edit Driver"; ?>
						</div>
						<form action="driver.php" method="post" id="signupForm1" class="form-horizontal">
							<div class="panel-body">
								<fieldset class="scheduler-border">
									<legend class="scheduler-border">Personal Information:</legend>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="Old">Name </label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="sname" pattern="[a-z]" name="sname" value="<?php echo $sname; ?>" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="Old">License</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="l_number" name="l_number" value="<?php echo $l_number; ?>" maxlength="8" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="Old">Contact </label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="contact" name="contact" pattern="{1,10} " value="<?php echo $contact; ?>" maxlength="10" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label" for="Old">Branch</label>
										<div class="col-sm-10">
											<select class="form-control" id="branch" name="branch">
												<option value="">Select Branch</option>
												<?php
												$sql = "select * from branch where delete_status='0' order by branch.branch asc";
												$q = $conn->query($sql);

												while ($r = $q->fetch_assoc()) {
													echo '<option value="' . $r['id'] . '"  ' . (($branch == $r['id']) ? 'selected="selected"' : '') . '>' . $r['branch'] . '</option>';
												}
												?>

											</select>
										</div>
									</div>


									<div class="form-group">
										<label class="col-sm-2 control-label" for="Old">Date </label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="joindate" name="joindate" value="<?php echo ($joindate != '') ? date("Y-m-d", strtotime($joindate)) : ''; ?>" style="background-color: #fff;" readonly />
										</div>
									</div>
								</fieldset>


								<fieldset class="scheduler-border">
									<legend class="scheduler-border">Fee Information:</legend>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="Old">Total Fees </label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="fees" maxlength="10" pattern={1,10} name="fees" value="<?php echo $fees; ?>" <?php echo ($action == "update") ? "disabled" : ""; ?> />
										</div>
									</div>

									<?php
									if ($action == "add") {
									?>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="Old">Advance Fee </label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="advancefees" name="advancefees" readonly />
											</div>
										</div>
									<?php
									}
									?>

									<div class="form-group">
										<label class="col-sm-2 control-label" for="Old">Balance </label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="balance" name="balance" value="<?php echo $balance; ?>" disabled />
										</div>
									</div>




									<?php
									if ($action == "add") {
									?>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="Password">Fee Remark </label>
											<div class="col-sm-10">
												<textarea class="form-control" id="remark" name="remark"><?php echo $remark; ?></textarea>
											</div>
										</div>
									<?php
									}
									?>

								</fieldset>

								<fieldset class="scheduler-border">
									<legend class="scheduler-border">Optional Information:</legend>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="Password">About Driver </label>
										<div class="col-sm-10">
											<textarea class="form-control" id="about" name="about"><?php echo $about; ?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label" for="Old">Email Id </label>
										<div class="col-sm-10">

											<input type="text" class="form-control" pattern="[A-Za-z]{3}" id="emailid" name="emailid" value="<?php echo $emailid; ?>" />
										</div>
									</div>
								</fieldset>

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








		<?php
		} else {
		?>

			<link href="css/datatable/datatable.css" rel="stylesheet" />



			<div class="rowbran">

				<div class="col-md-4">
					<div class="main-box mb-dull">
						<a href="http://localhost/finalviva-hdv2/RegisterFormQuick.php">
							<i class="fa fa-usd fa-5x"></i>
							<h5>Register Driver</h5>
						</a>
					</div>
				</div>

			</div>
	</div>
	<script src="js/dataTable/jquery.dataTables.min.js"></script>

	<script>
		$(document).ready(function() {
			$('#tSortable22').dataTable({
				"bPaginate": true,
				"bLengthChange": true,
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