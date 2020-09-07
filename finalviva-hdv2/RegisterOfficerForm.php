<?php
include "../finalviva-hdv2/db.php";
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

    <!-- Main css -->
    <link rel="stylesheet" href="cssRegister/style.css" />
    <!-- This is option one -->
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
                xmlhttp.open("GET", "getuser.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script>


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
                        <signupheade>Register Police Officer</signupheade>
                        <div class="errorTxt"></div>
                    </div>

                    <form name="myForm" method="POST" action="http://localhost/finalviva-hdv2/RegisterFormdbTest.php" class="register-form" id="register-form" onsubmit="return check()">
                        <div class="form-row">
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="first_name" class="required">Name</label>
                                    <input type="text" name="first_name" id="first_name" />
                                </div>
                                <div class="form-input">
                                    <label for="last_name" class="required">Officer ID </label>
                                    <input type="number" name="officer_id" maxlength="10" id="driverLicNo" />
                                </div>
                                <div class="form-select">
                                    <div class="label-flex">
                                        <label for="meal_preference">Police Station</label>
                                    </div>
                                    <div class="select-list">
                                        <div class="col-md-12">
                                            <select name="pol_station">
                                                <option value="0">Select a Branch:</option>
                                                <?php
                                                // Fetch Department
                                                $sql_department = "SELECT * FROM branch_tbl";
                                                $department_data = mysqli_query($conn, $sql_department);
                                                while ($row = mysqli_fetch_assoc($department_data)) {
                                                    $fine_id = $row['branch_id'];
                                                    $fine_name = $row['branch_name'];

                                                    // Option
                                                    echo "<option value='" . $fine_name . "' >" . $fine_name . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- id="meal_preference" -->
                                <div class="form-input">
                                    <label for="email" class="required">Email</label>
                                    <input type="text" name="email" id="email" />
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="form-input">
                                    <div class="form-input">
                                        <label for="phone_number" class="required">Phone number</label>
                                        <input type="number" maxlength="10" name="phone_number" id="phone_number" />
                                    </div>
                                    <div class="form-input">
                                        <label for="chequeno" class="required">Rank</label>
                                        <input type="text" name="rank" id="chequeno" />


                                    </div>
                                    <label for="chequeno" class="required">Password</label>
                                    <input type="password" name="repass" id="chequeno" />
                                </div>

                                <div class="form-input">
                                    <label for="payable" class="required">Confirm Password</label>
                                    <input type="password" name="pass" id="payable" data-rule-equalTo="#repass" />
                                </div>
                            </div>
                        </div>

                        <div class="form-submit">
                            <input type="submit" value="Submit" class="submit" id="submit" name="submit" />
                            <input type="submit" value="Reset" class="submit" id="reset" name="reset" />
                        </div>
                        <script>
                            function check() {
                                var x = document.forms["myForm"]["repass"].value;
                                var y = document.forms["myForm"]["pass"].value;
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