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
    <script type="text/javascript" src="vendorRegister/jquery/jquery-3.4.1.min.js"></script>
    <!-- Font Icon -->
    <link rel="stylesheet" href="fontsRegsiter/material-icon/css/material-design-iconic-font.min.css" />
    <link rel="stylesheet" href="vendorRegister/nouislider/nouislider.min.css" />

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
                    </div>
                    <form method="POST" action="http://localhost/finalviva-hdv2/RegisterFormdb.php" class="register-form" id="register-form">
                        <div class="form-row">
                            <div class="select-list">
                                <select name="meal_preference" id="meal_preference">
                                    <option value="0">-- Select --</option>
                                    <?php
                                    // Fetch Department
                                    $sql_department = "SELECT * FROM department";
                                    $department_data = mysqli_query($conn, $sql_department);
                                    while ($row = mysqli_fetch_assoc($department_data)) {
                                        $departid = $row['dept_id'];
                                        $depart_name = $row['department'];

                                        // Option
                                        echo "<option value='" . $departid . "' >" . $depart_name . "</option>";
                                    }
                                    ?>
                                    <!-- <option value="Kosher">Kosher</option>
                                    <option value="Asian Vegetarian">Asian Vegetarian</option> -->
                                </select>
                                <select id="sel_user">
                                    <option value="0">-- select --</option>
                                </select>
                                <!--       Script                  -->

                            </div>
                        </div>

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