<?php
include "../../finalviva-hdv2/db.php";

if (!$_SESSION['loggedindriver']) {
    header("location:index.php");
    die;
} else {
    if (!isset($_SESSION)) {
        session_start();
    }
    // $finenum = $_SESSION['finenum'];
    $spot_id = $_GET['spot_fine_id'];

    $query = "SELECT * FROM spot_fine_tbl WHERE spot_fine_id = '" . $spot_id . "'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $officer_id = $row["officer_id"];
        $driverLicNo = $row["driverLicNo"];
        $vehicle_No = $row["vehicle_No"];
        $fine_cate = $row["fine_cate"];
        $date = $row["date"];
        $expire_date = $row["expire_date"];
        $rate = $row["rate"];
        $pol_station = $row["pol_station"];
    } else {
        echo "No record found";
    }

    $queryprice = "SELECT price FROM fine WHERE fine_name = '" . $fine_cate . "'";
    $resultprice = mysqli_query($conn, $queryprice);
    if (mysqli_num_rows($resultprice) > 0) {
        $rowprice = mysqli_fetch_array($resultprice);
        $price = $rowprice["price"];
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

    <link rel="stylesheet" href="style.css" />
    <title>Login & Registration</title>
</head>

<body>
    <div class="container" id="container">

        <form method="POST" action="http://localhost/finalviva-hdv2/LoginpageDriver/PaidDB.php">
            <div class="center-finedetails">
                <h1>Fine Details----<?php echo $spot_id ?></h1>
            </div>
            <div class="form-containers sign-in-containerpay">
                <input type="hidden" name="spot_id" value="<?php echo $spot_id; ?>" />
                <label for="fine_cate">Spot Fine Category</label>
                <input type="text" name="fine_cate" value="<?php echo $fine_cate; ?>" readonly="readonly" />
                <label for="driverLicNo">Driver Licence No</label>
                <input type="text" name="driverLicNo" value="<?php echo $driverLicNo; ?>" readonly="readonly" />
                <label for="vehicle_No">Vehicle No</label>
                <input type="text" name="vehicle_No" value="<?php echo $vehicle_No; ?>" readonly="readonly" />
                <label for="date">Date</label>
                <input type="text" name="date" value="<?php echo $date; ?>" readonly="readonly" />
            </div>
            <div class="overlay-panel overlay-right">
                <label for="price">Price</label>
                <input type="text" name="price" value="<?php echo $price; ?>" readonly="readonly" />
                <label for="rate">Rate</label>
                <input type="text" name="rate" value="<?php echo $rate; ?>" readonly="readonly" />
                <label for="pol_station">Police Station</label>
                <input type="text" name="pol_station" value="<?php echo $pol_station; ?>" readonly="readonly" />
                <label for="officer_id">Officer ID</label>
                <input type="text" name="officer_id" value="<?php echo $officer_id; ?>" readonly="readonly" />
            </div>
            <div class="overlay-panelb overlay-right">
                <input type="submit" value="Submit" name="saveup" class="myButton" />
            </div>
        </form>

    </div>
    <script src="main.js"></script>
</body>

</html>