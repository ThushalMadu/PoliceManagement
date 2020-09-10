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
$email = $_SESSION["email"];
$expire_date =  date('Y-m-d');
$complain = $_SESSION["complain"];

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
    $data.='<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="add.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
   
      <h1>Payment Receipt</h1>
      <div id="company" class="clearfix">
      <div>Sri Lanka Police</div> 
      <div>No:Olcott Mawatha,<br /> Colombo,Sri Lanka</div>
      <div>(077) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      <div id="project">
        <div><span><b>Driver Licence </span>' . $driverLicNo . '</div>
        <div><span><b>Vehicle No <b></span>' . $vehicle_No . '</div>
        <div><span><b>Email <b> </span>' . $email . '</div>
        <div><span><b>Fine Date</b></span>' . $date . ' </div>
       
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">Offence</th>
            <th class="desc">DESCRIPTION</th>
           <th>PRICE</th>
            <th></th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="service">' . $fine_cate . '</td>
            <td class="desc">' . $complain . ' </td>
            <td class="unit">' . $price . '</td>       
             <td class="qty"></td>
        
            <td class="total">' . $price . '</td>
          </tr>
         
         
          <tr>
            <td colspan="4" class="grand total">GRAND TOTAL</td>
            <td class="grand total">' . $price . '</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Only vaild for 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>';
    
    
    // Write some HTML code:
    $mpdf->WriteHTML($data);

    // Output a PDF file directly to the browser
    $mpdf->Output('');
}
