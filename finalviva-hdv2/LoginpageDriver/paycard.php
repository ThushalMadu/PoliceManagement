<?php
include "../../finalviva-hdv2/db.php";
require_once __DIR__ . '/vendor/autoload.php';
if (!isset($_SESSION)) {
    session_start();
}
$spot_id = $_SESSION["spot_id"];
$driverLicNo = $_SESSION["driverLicNo"];
$vehicle_No = $_SESSION["vehicle_No"];
$fine_cate = $_SESSION["fine_cate"];
$date = $_SESSION["date"];
$price = $_SESSION["price"];
$datepay =  date('Y-m-d');

// $spot_id = $_POST['spot_id'];
// $driverLicNo = $_POST['driverLicNo'];
// $vehicle_No = $_POST['vehicle_No'];
// $fine_cate = $_POST['fine_cate'];
// $date = $_POST['date'];
// $price = $_POST['price'];

$sql = "UPDATE spot_fine_tbl SET statuspay='Paid' WHERE spot_fine_id= '" . $spot_id . "'";

$resultup = mysqli_query($conn, $sql);
if (!$resultup) {
    die('Could not update data: ');
} else {
    echo "Updated Successfully";
    // Create an instance of the class:
    $mpdf = new \Mpdf\Mpdf();
    $data = '';
    $data .= '<h1> This Your Spot Fine </h1>';
    $data .= '<strong> Driver Licence No : </strong>' . $driverLicNo . '<br/>';
    $data .= '<strong> Vehicle No        :  </strong>' . $vehicle_No . '<br/>';
    $data .= '<strong> Fine Type         : </strong>' . $fine_cate . '<br/>';
    $data .= '<strong> Date Pay Fine : </strong>' . $datepay . '<br/>';
    $data .= '<strong> Date              : </strong>' . $date . '<br/>';
    $data .= '<strong> Price             : </strong>' . $price . '<br/>';
    // Write some HTML code:
    $mpdf->WriteHTML($data);

    // Output a PDF file directly to the browser
    $mpdf->Output('');
}
