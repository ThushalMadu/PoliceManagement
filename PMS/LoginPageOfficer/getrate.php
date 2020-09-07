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
    $sql = "SELECT * FROM fine WHERE fine_name = '" . $q . "'";
    $result = mysqli_query($con, $sql);


    while ($row = mysqli_fetch_array($result)) {

        echo   $row['rate'];
    }

    mysqli_close($con);
    ?>
</body>

</html>