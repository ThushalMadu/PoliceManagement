<?php
include "../finalviva-hdv2/db.php";
$token = $_GET['token'];
// $finenum = $_SESSION['finenum'];
$query = "SELECT * FROM driver_tbl WHERE pass='" . $token . "' ";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_array($result);
  $driverLicNo = $row["driverLicNo"];
  $nic = $row["nic"];
  $phone_number = $row["phone_number"];
  $email = $row["email"];
} else {
  echo "No record found";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Police Department</title>

  <!-- Font Icon -->
  <link rel="stylesheet" href="fontsRegsiter/material-icon/css/material-design-iconic-font.min.css" />
  <link rel="stylesheet" href="vendorRegister/nouislider/nouislider.min.css" />
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <!-- Main css -->
  <link rel="stylesheet" href="cssRegister/style.css" />
</head>

<body>
  <div class="main">
    <div class="container">
      <div class="signup-content">
        <div class="signup-img">
          <img src="imagesRegister/form-img.jpg" alt="" />
          <div class="signup-img-content">
            <h2>Register now</h2>
            <p>Government Police Station</p>
          </div>
        </div>

        <div class="signup-form">
          <div class="signup-title">
            <signupheade>Register now</signupheade>
            <div class="errorTxt"></div>
          </div>
          <form method="POST" name="myForm" action="http://localhost/finalviva-hdv2/RegisterFormdb.php" class="register-form" id="register-form" onsubmit="return check()">
            <div class="form-row">
              <div class="form-group">
                <div class="form-input">
                  <label for="first_name" class="required">Name</label>
                  <input type="text" name="first_name" id="first_name" />
                </div>
                <div class="form-input">
                  <label for="last_name">Driver Licence No</label>
                  <input type="number" name="driverLicNo" id="driverLicNo" value="<?php echo $driverLicNo; ?>" readonly="readonly" />
                </div>
                <div class="form-input">
                  <label for="company" class="required">Address</label>
                  <input type="text" name="address" id="address" />
                </div>
                <div class="form-input">
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" value="<?php echo $email; ?>" readonly="readonly" />
                  <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" readonly="readonly" />
                </div>
              </div>
              <div class="form-group">
                <div class="form-input">
                  <div class="form-input">
                    <label for="phone_number">Phone number</label>
                    <input type="number" maxlength="10" name="phone_number" id="phone_number" value="<?php echo $phone_number; ?>" readonly="readonly" />
                  </div>
                  <div class="form-input">
                    <label for="chequeno">NIC No</label>
                    <input type="text" name="nic" id="nic" value="<?php echo $nic; ?>" readonly="readonly" />
                  </div>
                  <label for="chequeno" class="required">Password</label>
                  <input type="password" name="pass" id="chequeno" />
                </div>

                <div class="form-input">
                  <label for="payable" class="required">Confirm Password</label>
                  <input type="password" name="compass" id="payable" />
                </div>
              </div>
            </div>

            <div class="form-submit">
              <input type="submit" value="Submit" class="submit" id="submit" name="submit" />
              <input type="submit" value="Reset" class="submit" id="reset" name="reset" />
            </div>
            <script>
              function check() {
                var x = document.forms["myForm"]["pass"].value;
                var y = document.forms["myForm"]["compass"].value;
                if (x != y) {
                  alert("'Password' and 'Confirm password' must match.");
                  return false;
                }
              }
            </script>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="vendorRegister/jquery/jquery.min.js"></script>
  <script src="vendorRegister/nouislider/nouislider.min.js"></script>
  <script src="vendorRegister/wnumb/wNumb.js"></script>
  <script src="vendorRegister/jquery-validation/dist/jquery.validate.min.js"></script>
  <script src="vendorRegister/jquery-validation/dist/additional-methods.min.js"></script>
  <script src="jsRegister/main.js"></script>
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