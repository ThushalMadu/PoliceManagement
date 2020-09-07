<!DOCTYPE html>
<html>

<head>
</head>

<body>

    <?php
    $q = intval($_GET['q']);

    $con = mysqli_connect('localhost', 'root', '', 'policedep');
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }

    mysqli_select_db($con, "ajax_demo");
    $sql = "SELECT * FROM branch_tbl WHERE branch_id = '" . $q . "'";
    $result = mysqli_query($con, $sql);


    while ($row = mysqli_fetch_array($result)) {

        echo   $row['branch_name'];
    }

    mysqli_close($con);
    ?>
</body>

</html>