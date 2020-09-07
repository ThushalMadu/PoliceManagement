<?php
include "../finalviva-hdv2/db.php";

$departid = $_POST['depart'];   // department id

$sql = "SELECT dept_id , rate FROM department WHERE dept_id=" . $departid;

$result = mysqli_query($conn, $sql);
$users_arr = array();

while ($row = mysqli_fetch_array($result)) {
    $deptid = $row['dept_id'];
    $rate = $row['rate'];

    $users_arr[] = array("dept_id" => $deptid, "rate" => $rate);
}
echo json_encode($users_arr);
