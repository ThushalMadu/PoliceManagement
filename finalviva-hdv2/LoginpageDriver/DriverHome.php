<?php
include "../../finalviva-hdv2/db.php";

// header("refresh:5;url=wherever.php");

if (!$_SESSION['loggedindriver']) {
    header("location:index.php");
    die;
} else {

    if (!isset($_SESSION)) {
        session_start();
    }
    $email = $_SESSION['email'];
    $query = "SELECT `first_name`,`driverLicNo` FROM driver_tbl WHERE email = '" . $email . "'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $first_name = $row["first_name"];
        $driverLicNo = $row["driverLicNo"];
    } else {
        echo "No record found";
    }
}
?>



<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <script src="https://kit.fontawesome.com/c4e3c7b212.js" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="alink.css" />
    <title>Login & Registration</title>
</head>

<body>

    <div class="container" id="container">
        <div class="w3-container">
            <h2>The Fines You Have</h2>

            <p><em>Hey </em><?php echo $first_name; ?></p>
            <?php
            include "../../finalviva-hdv2/db.php";

            $querytable = "SELECT * FROM spot_fine_tbl WHERE driverLicNo='" . $driverLicNo . "' AND statuspay = 'pending' ";
            $resulttable = mysqli_query($conn, $querytable);

            echo "<table class=\"w3-table-all\">";
            echo "<thead>";
            echo "<tr class=\"w3-light-grey w3-hover-red\">";
            echo "<th>Fine ID</th>";
            echo "<th>Fine Name</th>";
            echo "<th>Date that Fine Issue</th>";
            echo "<th>Vehicle Number</th>";
            echo "<th>Expire Date</th>";
            echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";
            while ($datatable = mysqli_fetch_row($resulttable)) {
                echo "<tr class=\"w3-hover-green\">";
                echo "<td> $datatable[0]</td><td> $datatable[3]</td> <td>$datatable[4]</td> <td>$datatable[2]</td> <td>$datatable[5]</td>";
                // $_SESSION["finenum"] = $datatable[0];
                echo "<th> <a href='ShowFines.php?spot_fine_id=$datatable[0]'> Pay </a> </th>";
                echo "</tr>";
            }
            echo "</table>";
            ?>

        </div>



    </div>
    <div class="page">
        <br />
        <a href="DriverPayFines.php">
            <button type="button" class="btn btn-primary">Paid Fines</button>

        </a>
    </div>
    <a href="LogOut.php" class="link">Log Out</a>
    <script src="main.js"></script>

</body>

</html>